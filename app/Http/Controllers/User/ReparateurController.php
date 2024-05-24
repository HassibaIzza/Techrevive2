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
