<?php 

use App\Http\Controllers\User\ReparateurController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


/*Route::prefix('reparateur')->name('reparateur.')->group(function(){

    Route::middleware(['guest:reparateur'])->group(function(){
        Route::view('/login', 'auth.login')->name('login');
    });

    Route::middleware(['auth:reparateur'])->group(function(){

        Route::view('/profile', 'backend.profile.reparateur_profile')->name('profile');


    });
});*/

Route::middleware(['auth', 'auth.role:reparateur'])
    ->prefix('reparateur')
    ->name('reparateur-')
    ->controller(ReparateurController::class)->group(function (){

        // profile
        Route::view('profile', 'backend.profile.reparateur_profile')->name('profile');
       

      // fallback
        Route::fallback(function (){
            return redirect('/reparateur/profile');
        })->name('reparateur');
    });