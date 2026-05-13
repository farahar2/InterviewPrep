<?php

namespace App\Http\Controllers;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DomainController extends Controller
{
    public function index()
    {
      $domains = Auth::user()->domains()
          ->withCount('concepts') //eager loading pour eviter N+1
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
      // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|size:7', 
        ]);

        // Création du domaine lié à l'utilisateur authentifié
        Auth::user()->domains()->create($validated);

        // Redirection avec message de succès
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
