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
        return redirect()->route('domains.index')->with('success', 'Domaine créé avec succès !');
    }

    public function edit(string $id)
    {
      //Verification que le domaine appartient à l'utilisateur
        $this->authorize('update', $domain);
        return view('domains.edit', compact('domain'));
    }

    public function update(Request $request, string $id)
    {
        $this->authorize('update', $domain);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|size:7', 
        ]);

        $domain->update($validated);
        return redirect()->route('domains.index')->with('success', 'Domaine mis à jour avec succès !');
    }

    
    public function destroy(string $id)
    {
        $this->authorize('delete', $domain);
        $domain->delete();
        return redirect()->route('domains.index')->with('success', 'Domaine supprimé avec succès !');
    }
}
