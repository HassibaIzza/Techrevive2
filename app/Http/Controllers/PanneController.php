<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RendezVous;
use App\Models\Marque;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PanneController extends Controller
{
    public function index()
    {
        // Récupérer l'ID de l'utilisateur connecté
        $userId = Auth::id();

        // Récupérer le rôle de l'utilisateur connecté
        $role = Auth::user()->role;
        
        // Initialiser une variable pour stocker les rendez-vous
        $rendezvous = null;

        // Si l'utilisateur est un fournisseur (vendor) et est associé à une marque
        if ($role === 'Fabricant') {
            // Récupérer les rendez-vous pour la marque de l'utilisateur
            $rendezvous = RendezVous::where('marque', $userId)->get();
            
            // Récupérer le nom de la marque
            $marque = Marque::where('id', $userId)->value('name');
          

          
        } else {
            // Si l'utilisateur n'est pas un fournisseur ou n'est pas associé à une marque, afficher tous les rendez-vous
            $rendezvous = RendezVous::all();
            $marque = null; // Aucune marque spécifique à afficher
        }
          
        // Exécuter la requête SQL pour récupérer les rendez-vous en fonction de l'utilisateur connecté
        $rendezvous = DB::select("
            SELECT * FROM rendez_vouses, marques, users 
            WHERE rendez_vouses.Marque=marques.id 
            AND marques.owner_id=users.id 
            AND users.id='$userId'
        ");

        // Passer les données à la vue
        return view('backend.Les pannes.listepannes', compact('rendezvous', 'marque', 'role'));
    }
}
