<?php



// app/Http/Controllers/CvController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reparateur;

class CvController extends Controller
{
  public function showProfile($id)
  {
      // Récupérer les informations de l'utilisateur avec le rôle de réparateur et les détails du réparateur
      $user = User::with('reparateur')->where('id', $id)->where('role', 'reparateur')->first();

      // Vérifier si l'utilisateur est trouvé
      if (!$user) {
          return redirect()->back()->with('error', 'Utilisateur non trouvé');
      }

      // Récupérer les informations du réparateur en utilisant une jointure
      $reparateur = User::join('reparateur', 'users.id', '=', 'reparateur.user_id')
                         ->select('users.*', 'reparateur.*')
                         ->where('users.id', $id)
                         ->where('role', 'reparateur')
                         ->first();

      // Vérifier si le réparateur est trouvé
      if (!$reparateur) {
          return redirect()->back()->with('error', 'Réparateur non trouvé');
      }

      // Passer les informations du réparateur à la vue
      return view('cv', ['reparateur' => $reparateur, 'user' => $user]);
  }
}
