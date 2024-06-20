<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BrandModel;
use App\Models\User;
use App\MyHelpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;


class UserController extends Controller
{

    /**
     * To update the image of an authenticated user ( admin, vendor, or any user )
     * @param Request $request
     */
    public function updateImage(Request $request){

        $image = $request->file('image');
        if ($image)
        {
            // validate the new image
            $allowedExtensions = 'gif,jpg,jpeg,png,svg,webp,ico';
            $data = $request->validate([
                    'image' => ['nullable', 'image', 'mimes:' . $allowedExtensions, 'max:4096']
                ],
                [
                    'image.image' => 'The file must be an image.'
                ]
            );

            // upload it
            $data['photo'] = MyHelpers::uploadImage($image, 'uploads/images/profile');

            // update image in db
            try {
                $user = User::findOrFail(Auth::id())->update($data);
                if ($user){
                    // remove the old image
                    MyHelpers::deleteImageFromStorage(Auth::user()->photo, 'uploads/images/profile/');
                    return response(['msg' => 'Your image is updated successfully'],200);
                }
            }catch (ModelNotFoundException $exception){
                toastr()->error('failed to update the new image');
                return redirect()->back();
            }
        }
    }

    // Modifier les informations utilisateurs
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


    /**
     * To update the password of any user.
     * @param Request $request
     */
    public function updatePassword(Request $request)
    {
        // Validation des champs
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        // Vérification de l'ancien mot de passe
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Le mot de passe actuel est incorrect.']);
        }

        // Mise à jour du mot de passe
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Mot de passe mis à jour avec succès.');
    }


}
