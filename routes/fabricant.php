<?php
use App\Http\Controllers\User\FabricantController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'auth.role:Fabricant'])
    ->prefix('Fabricant')
    ->name('Fabricant-')
    ->controller(FabricantController::class)->group(function (){

        // profile
        Route::view('profile', 'backend.profile.fabricant_profile')->name('profile');
        Route::post('profile/update_info', 'updateInfo')->name('profile-info-update');
        Route::post('profile/update_image', 'updateImage')->name('profile-image-update');
        Route::post('profile/update_password', 'updatePassword')->name('profile-password-update');

      // fallback
        Route::fallback(function (){
            return redirect('/Fabricant/profile');
        })->name('brand-fallback');
    });