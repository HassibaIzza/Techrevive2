<?php

namespace App\Http\Controllers\User;
use App\Http\Requests\User\ReparateurInfoRequest;
use App\Models\User;
use App\MyHelpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Reparateurcontroller extends UserController
{

    /**
     * To handle the request of updating info of a client
     * @param ReparateurInfoRequest $request
     */
    
    

    public function updateInfo(ReparateurInfoRequest $request)
    {
        $data = $request->validated();
 
         // Assuming you want to update the authenticated user's info

         // preparing some needed data
        $userId = Auth::id();
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address']
        ];


        if ($this->updateUserData($userId, $userData) )
            return response(['msg' => "Your Info is updated successfully"], 200);
        else{
            toastr()->error('Failed to save changes, try again.');
            return redirect()->route('reparateur-profile');
        }
    }

    private function updateUserData(int $userId, Array $data): bool{
        return User::findOrFail($userId)->update($data);
    }


    


}
