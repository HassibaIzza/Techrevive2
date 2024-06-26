<?php

namespace App\Http\Controllers;
use App\Models\Marque;
use App\Models\Typep;
use App\Models\Typepanne;
use App\Models\RendezVous;
use App\Models\User;
use App\Notifications\BrandOwnerNotification;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmailController extends Controller
{

    public function create()
    {
      $marques = \DB::table('marques')->orderBy('name', 'ASC')->get(); // Utilisez la table "marques"
      return view('gmail', ['marques' => $marques]);
    }
    public function fetchStates($marque_id = null) {
      $typep = \DB::table('typeps')->where('marque_id',$marque_id)->get();

      return response()->json([
          'status' => 1,
          'typep' => $typep
      ]);
  }


  public function fetchCities($typep_id = null) {
    $typepanne = \DB::table('typepannes')->where('typep_id',$typep_id)->get();

    return response()->json([
        'status' => 1,
        'typepanne' => $typepanne
    ]);
}



    public function sendEmail(Request $request)
    {
      $user_id = $request->id;
        $request->validate([
          'email' => 'required|email',
          'adresse' => 'required',
          'name' => 'required',
          'content' => 'required',
          'typepanne' => 'required',
          'marque' => 'required',
          'typep'=> 'required',
        ]);

        // Récupérer le nom de la marque à partir de l'ID
    $marque = Marque::find($request->marque);
    $marqueName = $marque ? $marque->name : '';

    $typep = Typep::find($request->typep); // Utilisation du modèle Typep
    $typepName = $typep ? $typep->name : '';

    $typepanne = Typepanne::find($request->typepanne); // Utilisation du modèle Typepanne
    $typepanneName = $typepanne ? $typepanne->name : '';

    // Récupérer l'adresse Gmail de la marque à partir de son ID
    $marque = Marque::find($request->marque);
    $gmail = $marque ? $marque->gmail : '';
    $client_id = Auth::id();
        $data = [
            'adresse' => $request->adresse,
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
            'typepanne' => $typepanne ? $typepanne->name : '',
            'typep' => $typep ? $typep->name : '',
            'client_id' => Auth::id(),


        ];

        echo"";
        // Créer une instance de RendezVous avec les données à enregistrer
        $rendezVous = new RendezVous();
        $rendezVous->mail = $request->email;

        $rendezVous->marque = $request->marque;

        $rendezVous->catégorie = $typep ? $typep->name : '';
        $rendezVous->panne = $typepanne ? $typepanne->name : '';
        $rendezVous->problème = $request->content;
        $rendezVous->nom = $request->name;
        $rendezVous->sujet = $request->adresse;
        $rendezVous->client_id = Auth::id();
        $rendezVous->save();

        /*Mail::send('email-template', $data, function($message) use ($data) {
          $message->to('hadjerjawan@gmail.com')
          ->subject($data['subject']);
        });*/
        // Envoi de l'email à l'adresse Gmail de la marque

        Mail::send('email-template', $data, function ($message) use ($data, $gmail) {
        $message->to($gmail) // Envoyer à l'adresse Gmail de la marque
          ->subject('Panne d\'une appareil');
  });
  //récupération de l'utilisateur propriétaire de la marque
      $marque = Marque::find($request->marque);
      if ($marque && $marque->owner_id) {
          $owner = User::find($marque->owner_id);
          if ($owner) {
            $details = "Une nouvelle demande de service a été soumise ";
            $url = route('listepannes', ['id' => $marque->id]);
            $owner->notify(new BrandOwnerNotification($details, $url));
          }
      }

      return back()->with(['message' => 'Demande envoyer avec succès']);



        //return back()->with(['message' => 'Message envoyé avec succés!']);


    }


    public function sendContact(Request $request)
    {
      $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'content' => 'required',
      ]);

      $data = [
        'name' => $request->name,
        'email' => $request->email,
        'content' => $request->content,
      ];
      $gmail = 'hassibaizza827@gmail.com' ;
      Mail::send('EmailContact-Template', $data, function ($message) use ($data, $gmail) {
        $message->to($gmail)
          ->subject('Nouveau Contact');
      });

      return back()->with(['message' => 'Email envoyer avec succées !']);

    }

}
