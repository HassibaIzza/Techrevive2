<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\AdminInfoRequest;
use App\Models\User;
use App\MyHelpers;
use App\Notifications\VendorActivated;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AdminController extends UserController
{
    /**
     * Update the info of the admin
     * @param AdminInfoRequest $request
     */
    

    public function userRemove(Request $request){
        try {
            
            $user = User::findOrFail($request->id);
            if ($user->photo) {
                MyHelpers::deleteImageFromStorage($user->photo, 'uploads/images/profile/');
            }
            if ($user->delete())
                return redirect()->route('admin-vendor-list')->with('success', 'Successfully removed.');
            else
                return redirect('admin-vendor-list')->with('error', 'Failed to remove this user.');
        }catch (ModelNotFoundException $exception){
            return redirect('admin-vendor-list')->with('error', 'Failed to remove this user.');
        }
    }

    public function vendorActivate(Request $request){
        $user_id = $request->vendor_id;

        // check whether activate or de-activate
        if ($request->current_status == "1"){
            return $this->vendorDeActivate($user_id);
            return response(['msg' => 'utilisateur activé avec succées.'], 200);
        }

        try {
            $vendor = User::findOrFail($user_id);
            $vendor->update(['status' => 1]);
            return response(['msg' => 'utilisateur activer avec succées .'], 200);
            // notify the vendor
            $url = route('/');
            Notification::send($vendor, new VendorActivated($url));

            
        }catch (ModelNotFoundException $exception){
            return redirect()->route('admin-vendor-list')->with('error', 'Failed to activate this user, try again');
        }
    }
    public function vendorDeActivate(int $user_id){

        try {
            User::findOrFail($user_id)->update(['status' => 0]);
            return response(['msg' => 'Utilisateur désactiver avec succées.'], 200);
        }catch (ModelNotFoundException $exception){
            return redirect()->route('admin-vendor-list')->with('error', 'Failed to activate this user, try again');
        }
    }

}
