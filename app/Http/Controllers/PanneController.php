<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RendezVous;
use App\Models\Marque;
use App\Models\Typep;
use App\Models\Typepanne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PanneController extends Controller
{
  public function index()
  {
      // Récupérer l'ID de l'utilisateur connecté
    $userId = Auth::id();

      // Récupérer le rôle de l'utilisateur connecté
    $role = Auth::user()->role;

      // Récupérer la marque de l'utilisateur connecté
      $userMarque = Marque::where('owner_id', $userId)->first();
  
      // Vérifier si la marque a été trouvée
      if ($userMarque) {
          $marque = $userMarque->name;
  
          // Récupérer les catégories de la même marque que l'utilisateur connecté
          $categories = Typep::where('Marques_id', $userMarque->id)->pluck('name');
      } else {
          $marque = 'marque inconnue';
          $categories = [];
      }

      
  
      // Requête SQL pour récupérer les rendez-vous en fonction de l'utilisateur connecté
      $rendezvous = DB::select("
          SELECT rendez_vouses.*, marques.name as marque_name, 
                 COALESCE(typeps.name, rendez_vouses.catégorie) as categorie_name 
          FROM rendez_vouses 
          LEFT JOIN typeps ON rendez_vouses.catégorie = typeps.id 
          JOIN marques ON rendez_vouses.marque = marques.id 
          JOIN users ON marques.owner_id = users.id 
          WHERE users.id = ?", [$userId]);


           //Pour récupérer le nom de la catégories et le nom de la panne
          foreach ($rendezvous as $rdv) {
        
            $typep = Typep::find($rdv->catégorie);
            $rdv->nom_catégorie = $typep ? $typep->name : $rdv->catégorie;
            $typepanne = Typepanne::find($rdv->panne);
            $rdv->nom_panne = $typepanne ? $typepanne->name : $rdv->panne;
        }
  
      // Passer les données à la vue
      return view('backend.les pannes.listepannes', compact('rendezvous', 'marque', 'role', 'categories'));
  }
  

  //pour l'état de réparation
  public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|integer|in:0,1,2'
    ]);

    $rendezvous = RendezVous::findOrFail($id);
    $rendezvous->status = $request->input('status');
    $rendezvous->save();

    return redirect()->back()->with('success', 'Status de réparation mis à jour avec succès.');
}

 

//pour télécharger le fichier pdf
 

}
