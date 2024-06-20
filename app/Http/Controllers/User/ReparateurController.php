<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Models\Reparateur;
use App\Http\Requests\User\ReparateurInfoRequest;
use App\Models\User;
use App\MyHelpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class Reparateurcontroller extends UserController
{

    /**
     * To handle the request of updating info of a client
     * @param ReparateurInfoRequest $request
     */
    
    

     public function updateRepInfo(Request $request)
     {
       // Assuming you want to update the authenticated user's info
         // preparing some needed data
         $request->validate([
          'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
          'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
          'username' => ['required', 'string', 'max:100', Rule::unique('users')->ignore(Auth::id())],
          
      ],[
          'email.required'=>'l\'address mail est Obligatoire ',
          'username.required'=>'le nom d\'utilisateur est obligatoire ',
          
      ]);

      $user = Auth::user();
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->username = $request->input('username');
      if($user->save()){
              return redirect()->back()->with('success', 'informations mis à jour avec succès');
      }else{
          return redirect()->back()->with('error', 'Informations invalide');
      }

     }

     public function store(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'service_type' => 'required|string|max:255',
            'short_description' => 'required|string',
            'id' => 'id|int',

        ]);

        Reparateur::create([
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'service_type' => $request->service_type,
            'short_description' => $request->short_description,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Reparateur profile created successfully.');
    }

}
