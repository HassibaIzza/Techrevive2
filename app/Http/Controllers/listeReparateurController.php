<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ListeReparateurController extends Controller
{
    public function index()
    {
        // Récupérer les utilisateurs avec leurs informations de réparateur et le type de service
        $reparateurs = User::select('users.name', 'users.photo', 'reparateur.service_type', 'users.id') 
                            ->join('reparateur', 'users.id', '=', 'reparateur.user_id')
                            ->where('users.role', 'reparateur')
                            ->get();


        // Passer les réparateurs récupérés à la vue
        return view('backend.reparateur.reparateurs', compact('reparateurs'));
    }
}
