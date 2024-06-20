<?php

namespace App\Http\Controllers\User;
use App\Http\Requests\User\ClientInfoRequest;
use App\Models\User;
use App\MyHelpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;



class ClientController extends UserController
{

    /**
     * To handle the request of updating info of a client
     * @param ClientInfoRequest $request
     */
    
    

    public function updateInfo(Request $request)
    {
         // Assuming you want to update the authenticated user's info
         // preparing some needed data
            $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'username' => ['required', 'string', 'max:100', Rule::unique('users')->ignore(Auth::id())],
            'phone_number' => ['nullable', 'string', 'size:10'],
            'address' => ['nullable', 'string', 'max:200'],
        ],[
            'phone_number.size' => 'le numéro de téléphone doit etre égale à 10 caractére ',
            'email.required'=>'l\'address mail est Obligatoire ',
            'username.required'=>'le nom d\'utilisateur est obligatoire ',
            
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');
        if($user->save()){
                return redirect()->back()->with('success', 'Profil mis à jour avec succès');
        }else{
            return redirect()->back()->with('error', 'Informations invalide');
        }

    }

    

    private function updateUserData(int $userId, Array $data): bool{
        return User::findOrFail($userId)->update($data);
    }


    


}
