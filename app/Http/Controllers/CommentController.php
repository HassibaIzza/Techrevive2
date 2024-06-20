<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reparateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function showComments($id)
    {
        
            // Récupérer les commentaires pour le réparateur spécifique
            $reparateur = Reparateur::findOrFail($id);
            $comments = $reparateur->comments()->with('user')->get();

            return view('comment.show', [
                'reparateur' => $reparateur,
                'comments' => $comments
            ]);
        
    }
    public function destroy(Comment $comment)
{
    // Vérifier si l'utilisateur connecté est l'auteur du commentaire ou un administrateur
    if (Auth::user()->id === $comment->user_id || Auth::user()->role === 'admin') {
        $comment->delete();
        return redirect()->back()->with('success', 'Commentaire supprimé.');
    } else {
        return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer ce commentaire.');
    }
}
}


