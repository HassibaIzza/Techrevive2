<?php

namespace App\Http\Controllers\User;
use App\Http\Requests\User\ReparateurInfoRequest;
use App\Models\User;
use App\MyHelpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Reparateurcontroller extends UserController
{

    /**
     * To handle the request of updating info of a client
     * @param ReparateurInfoRequest $request
     */
    
    

     public function updateInfo(ReparateurInfoRequest $request)
     {
       $validatedData = $request->validated();
     
       $userId = Auth::user(); // Assuming you're using Auth::user() to get the logged-in user
     
       $user = User::findOrFail($userId);
       $user->fill($validatedData);
  // Fill user model with validated data
     
       if ($user->save()) {
         Log::info('User updated successfully.');
         return redirect()->route('reparateur-profile')->with('success', 'Your info is updated successfully.');
       } else {
         // Handle saving errors (e.g., log specific errors)
         Log::error('Failed to save user data: ' . $user->getErrors());
         return redirect()->route('reparateur-profile')->with('error', 'Failed to save changes, try again.');
       }
     }
}
