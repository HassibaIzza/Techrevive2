<?php



namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ChatbotController extends Controller
{
    public function getMessage(Request $request)
    {
        // Récupérer le texte de la requête de l'utilisateur
        $getMesg = $request->input('text');

        // Exécuter la requête SQL pour récupérer la réponse correspondante
        $result = DB::select("SELECT replies FROM bot WHERE queries LIKE '%$getMesg%'");

        // Vérifier si une réponse a été trouvée
        if (!empty($result)) {
            // Renvoyer la réponse trouvée
            return response()->json(['reply' => $result[0]->replies]);
        } else {
            // Renvoyer un message par défaut si aucune réponse trouvée
            return response()->json(['reply' => "Sorry, I can't understand you!"]);
        }
    }
}
