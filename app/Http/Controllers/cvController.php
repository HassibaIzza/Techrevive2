<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assurez-vous d'importer le modèle Reparateur

class cvController extends Controller

{
  public function showProfile($id)
{

  
    // Récupérer les informations du réparateur à partir de son ID
    $reparateur = User::where('id', $id)->where('role', 'reparateur')->first();
    
    // Vérifier si le réparateur est trouvé
    if (!$reparateur) {
        // Gérer le cas où le réparateur n'est pas trouvé, par exemple, rediriger ou afficher un message d'erreur
        return redirect()->back()->with('error', 'Réparateur non trouvé');
    }
    
    // Passer les informations du réparateur à la vue
    return view('cv', ['reparateur' => $reparateur]);
}




}


