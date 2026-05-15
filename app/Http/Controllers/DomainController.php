<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DomainController extends Controller
{
    public function index()
    {
        $domains = Auth::user()->domains()
            ->withCount('concepts')
            ->latest()
            ->get();

        return view('domains.index', compact('domains'));
    }

    public function create()
    {
        return view('domains.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|size:7',
        ]);

        Auth::user()->domains()->create($validated);

        return redirect()->route('domains.index')->with('success', 'Domain created successfully!');
    }

    public function edit(Domain $domain)
    {
        $this->authorize('update', $domain);
        return view('domains.edit', compact('domain'));
    }

    public function update(Request $request, Domain $domain)
    {
        $this->authorize('update', $domain);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|size:7',
        ]);

        $domain->update($validated);
        return redirect()->route('domains.index')->with('success', 'Domain updated successfully!');
    }

    public function destroy(Domain $domain)
    {
        $this->authorize('delete', $domain);
        $domain->delete();
        return redirect()->route('domains.index')->with('success', 'Domain deleted successfully!');
    }
}
