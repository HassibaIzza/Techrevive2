<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ReparateurController extends Controller
{
    public function index()
    {
        // Récupérer tous les utilisateurs avec le rôle de réparateur depuis la base de données
        $reparateurs = User::where('role', 'reparateur')->get();
        
        // Passer les réparateurs récupérés à la vue
        return view('backend.reparateur.reparateurs', compact('reparateurs'));

    }
}
