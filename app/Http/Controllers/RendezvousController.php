<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RendezVous;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RendezVousNotification;

class RendezvousController extends Controller
{
    public function rendezvous()
{
    $Id = request()->query('id'); // Récupérer l'ID du client de la requête
    return view('bookings.create', compact('Id'));
}





public function store(Request $request)
{
    $validatedData = $request->validate([
        'date_rendezvous' => 'required|date|after_or_equal:today',
        'short_description' => 'required',
    ],[
        'date_rendezvous.required' => 'La date de rendez-vous est obligatoire.',
        'date_rendezvous.date' => 'La date de rendez-vous doit être une date valide.',
        'date_rendezvous.after_or_equal' => 'La date de rendez-vous ne peut pas être dans le passé.',
        'short_description.required' => 'La description courte est obligatoire.',
    ]);

    // Récupérer l'ID du client depuis le formulaire
    $Id = $request->input('id');

    if ($Id) {
        // Récupérer le rendez-vous existant basé sur l'ID du client
        $rendezVous = RendezVous::where('id', $Id)->first();

        if (!$rendezVous) {
            return redirect()->back()->with('error', 'Rendez-vous introuvable.');
        }

        // Récupérer le client par son ID
        $client = User::find($Id);


        // Mettre à jour les champs du rendez-vous
        $rendezVous->date_rendez_vous = $validatedData['date_rendezvous'];
        $rendezVous->short_desc = $validatedData['short_description'];
        $rendezVous->save();

        //envoyer la notification
        $details = "Vous Avez un Rendez-vous ";
        $url = route("demandes.recentes");              
        $client->notify(new RendezVousNotification($details, $url));
        return redirect()->route('bookings.create')->with('success', 'Rendez-vous mis à jour avec succès.');
    } else {
        return redirect()->back()->with('error', 'ID de rendez vous manquant.');
    }
}

}