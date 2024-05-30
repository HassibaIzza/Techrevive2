<?php 

use App\Http\Controllers\User\ClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth', 'auth.role:client'])
    ->prefix('client')
    ->name('client-')
    ->controller(ClientController::class)->group(function (){

        // profile
        Route::view('profile', 'backend.profile.client_profile')->name('profile');
        Route::post('profile/update_image', 'updateImage')->name('profile-image-update');
        Route::post('profile', 'updateInfo')->name('profile-info-update');
        Route::post('profile/update_password', 'updatePassword')->name('profile-password-update');


      // fallback
        Route::fallback(function (){
            return redirect('/client/profile');
        })->name('client');
    });

