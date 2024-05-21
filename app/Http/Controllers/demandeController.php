<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RendezVous;
use App\Models\Marque;
use App\Models\Typep;
use App\Models\TypePanne;

class demandeController extends Controller
{
    public function index()
    {
        // Initialisez la variable comme une collection vide
        $rendezvous = collect();

        // Récupérer l'ID de l'utilisateur connecté
        $userId = Auth::id();

        // Récupérer les demandes de panne du client connecté
        $rendezvous = RendezVous::where('client_id', $userId)->get();

        foreach ($rendezvous as $rdv) {
          $marque = Marque::find($rdv->marque);
          $rdv->nom_marque = $marque ? $marque->name : 'Marque inconnue';
          $typep = Typep::find($rdv->catégorie);
          $rdv->nom_catégorie = $typep ? $typep->name : 'catégorie inconnue';
      }

        // Retourner les rendez-vous récupérés à une vue
        return view('backend.Les pannes.listedemande', compact('rendezvous'));
    }




    public function edit($id)
    {
        $rendezvous = RendezVous::findOrFail($id);
        $marques = Marque::all();
        $categories = Typep::where('marque_id', $rendezvous->Marque)->get();
        $pannes = TypePanne::where('typep_id', $rendezvous->catégorie)->get(); // Assurez-vous de filtrer par catégorie

        return view('backend.Les pannes.editdemande', compact('rendezvous', 'marques', 'categories', 'pannes'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'catégorie' => 'required|string|max:255',
            'panne' => 'required|string|max:255',
            'problème' => 'required|string|max:255',
        ]);

        $rendezvous = RendezVous::findOrFail($id);
        $rendezvous->update($validatedData);

        return redirect()->route('demandes.index')->with('success', 'Demande mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $rendezvous = RendezVous::findOrFail($id);
        $rendezvous->delete();

        return redirect()->route('demandes.index')->with('success', 'Demande supprimée avec succès.');
    }

    public function fetchStates($marque_id)
    {
        $typep = Typep::where('marque_id', $marque_id)->get();

        return response()->json([
            'status' => 1,
            'typep' => $typep->pluck('name')
        ]);
    }

    public function fetchCities($typep_id)
    {
        $typepannes = TypePanne::where('typep_id', $typep_id)->get();

        return response()->json([
            'status' => 1,
            'typepannes' => $typepannes->pluck('name')
        ]);
    }
}


