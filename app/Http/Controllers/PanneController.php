<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RendezVous;
use App\Models\Marque;
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

        // Requête SQL pour récupérer les rendez-vous en fonction de l'utilisateur connecté
        $rendezvous = DB::select("
            SELECT rendez_vouses.*, marques.name as marque_name, 
                   COALESCE(typeps.name, rendez_vouses.catégorie) as categorie_name 
            FROM rendez_vouses 
            LEFT JOIN typeps ON rendez_vouses.catégorie = typeps.id 
            JOIN marques ON rendez_vouses.marque = marques.id 
            JOIN users ON marques.owner_id = users.id 
            WHERE users.id = ?", [$userId]);

        // Récupérer le nom de la marque de l'utilisateur
        $marque = Marque::where('owner_id', $userId)->value('name');

        // Passer les données à la vue
        return view('backend.Les pannes.listepannes', compact('rendezvous', 'marque', 'role'));
    }
}
