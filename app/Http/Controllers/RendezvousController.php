<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RendezVous;
use Illuminate\Support\Facades\Auth;

class RendezvousController extends Controller
{
    public function rendezvous()
{
    $clientId = request()->query('client_id'); // Récupérer l'ID du client de la requête
    return view('bookings.create', compact('clientId'));
}
public function store(Request $request)
{
    $validatedData = $request->validate([
        'date_rendezvous' => 'required',
        'short_description' => 'required',
    ]);

    // Récupérer l'ID du client depuis le formulaire
    $clientId = $request->input('client_id');

    if ($clientId) {
        // Récupérer le rendez-vous existant basé sur l'ID du client
        $rendezVous = RendezVous::where('client_id', $clientId)->first();

        if (!$rendezVous) {
            return redirect()->back()->with('error', 'Rendez-vous introuvable.');
        }

        // Mettre à jour les champs du rendez-vous
        $rendezVous->date_rendez_vous = $validatedData['date_rendezvous'];
        $rendezVous->short_desc = $validatedData['short_description'];
        $rendezVous->save();

        return redirect()->route('bookings.create')->with('success', 'Rendez-vous mis à jour avec succès.');
    } else {
        return redirect()->back()->with('error', 'ID de client manquant.');
    }
}

}