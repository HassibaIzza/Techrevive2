<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use App\Models\Reparateur;
use App\Models\User;
use App\Models\comment;

class CvController extends Controller
{
public function showProfile($id)
{
    // Récupérer l'utilisateur avec le rôle de réparateur
    $user = User::with('reparateur')->where('id', $id)->where('role', 'reparateur')->first();

    if (!$user) {
        return redirect()->back()->with('error', 'Utilisateur non trouvé');
    }

    // Effectuer une jointure pour récupérer les informations du réparateur
    $reparateur = User::join('reparateur', 'users.id', '=', 'reparateur.user_id')
                      ->select('users.*', 'reparateur.*')
                      ->where('users.id', $id)
                      ->where('role', 'reparateur')
                      ->first();

    if (!$reparateur) {
        return redirect()->back()->with('error', 'Réparateur non trouvé');
    }

    // Récupérer les commentaires du réparateur
    $comments = $reparateur->comments;

    // Passer les données à la vue
    return view('cv', ['reparateur' => $reparateur, 'user' => $user, 'comments' => $comments]);
}



  
    public function storeComment(Request $request)
    {
        // Récupérer les données du formulaire
        $commentText = $request->input('comment');
        $reparateurId = $request->input('reparateur_id');
        $userId = Auth::id(); // Obtenir l'ID de l'utilisateur authentifié
    
        // Insérer le commentaire dans la base de données
        $comment = new Comment(); // Assurez-vous d'importer le modèle Comment
        $comment->user_id = $userId;
        $comment->reparateur_id = $reparateurId;
        $comment->comment_text = $commentText;
        $comment->save();
      
        
        // Redirection ou réponse appropriée
        return redirect()->back()->with('success', 'Commentaire ajouté avec succès!');
    }

    public function show($id)
{
    // Récupérer le réparateur avec ses commentaires et les utilisateurs associés aux commentaires
    $reparateur = Reparateur::with('comments.user')->findOrFail($id);
    // Debug ici
    dd($reparateur);
    

    // Passer les données récupérées à la vue
    return view('reparateurs.show', compact('reparateur'));
}




    
}
