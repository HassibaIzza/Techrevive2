<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RendezVous;

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

        // Retourner les rendez-vous récupérés à une vue
        return view('backend.Les pannes.listedemande', compact('rendezvous'));
    }
}
