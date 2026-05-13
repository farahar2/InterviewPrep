<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConceptController extends Controller
{
    /**
     * Display concepts for a specific domain
     */
    public function index(Domain $domain)
    {
        // Verify user owns this domain
        $this->authorize('view', $domain);

        // Get all concepts with optional status filter
        $concepts = $domain->concepts()
            ->byStatus(request('status'))
            ->byDifficulty(request('difficulty'))
            ->latest()
            ->get();

        return view('concepts.index', compact('domain', 'concepts'));
    }

    /**
     * Show the form for creating a new concept
     */
    public function create(Domain $domain)
    {
        $this->authorize('view', $domain);

        return view('concepts.create', compact('domain'));
    }

    /**
     * Store a newly created concept
     */
    public function store(Request $request, Domain $domain)
    {
        $this->authorize('view', $domain);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'explanation' => 'required|string',
            'difficulty' => 'required|in:junior,mid,senior',
        ]);

        // Status is always 'to_review' for new concepts
        $domain->concepts()->create([
            ...$validated,
            'user_id' => Auth::id(),
            'status' => 'to_review',
        ]);

        return redirect()->route('concepts.index', $domain)
            ->with('success', 'Concept created successfully!');
    }

    /**
     * Display the specified concept
     */
    public function show(Concept $concept)
    {
        $this->authorize('view', $concept);

        // Load generations for the AI questions section
        $concept->load('generations');

        return view('concepts.show', compact('concept'));
    }

    /**
     * Show the form for editing the specified concept
     */
    public function edit(Concept $concept)
    {
        $this->authorize('update', $concept);

        return view('concepts.edit', compact('concept'));
    }

    /**
     * Update the specified concept
     */
    public function update(Request $request, Concept $concept)
    {
        $this->authorize('update', $concept);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'explanation' => 'required|string',
            'difficulty' => 'required|in:junior,mid,senior',
            'status' => 'required|in:to_review,in_progress,mastered',
        ]);

        $concept->update($validated);

        return redirect()->route('concepts.show', $concept)
            ->with('success', 'Concept updated successfully!');
    }

    /**
     * Quick status change via AJAX (US9)
     */
    public function updateStatus(Request $request, Concept $concept)
    {
        $this->authorize('update', $concept);

        $validated = $request->validate([
            'status' => 'required|in:to_review,in_progress,mastered',
        ]);

        $concept->update(['status' => $validated['status']]);

        // Return JSON for AJAX response
        return response()->json([
            'success' => true,
            'status' => $concept->status,
            'formatted_status' => $concept->formatted_status,
        ]);
    }

    /**
     * Remove the specified concept (soft delete)
     */
    public function destroy(Concept $concept)
    {
        $this->authorize('delete', $concept);

        $domain = $concept->domain;
        $concept->delete(); // Soft delete thanks to SoftDeletes trait

        return redirect()->route('concepts.index', $domain)
            ->with('success', 'Concept archived successfully!');
    }
}