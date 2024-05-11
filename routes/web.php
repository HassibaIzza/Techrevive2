<?php

use Illuminate\Support\Facades\Route;
 
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReparateurController;
use App\Http\Controllers\RendezvousController;
use App\Http\Controllers\PanneController;
use App\Http\Controllers\ChatbotController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*chatbot*/
Route::get('/chatbot1', function () {
    return view('chatbot.chatbot');
  });
  Route::post('/get-message', [ChatbotController::class, 'getMessage'])->name('get-message');
  
  
  Route::get('/liste-des-pannes', [PanneController::class, 'index'])->name('listepannes');
/*fin_chatbot */

/*réparateurs*/
Route::get('/reparateur-product', 'ProductController@reparateurProduct')->name('reparateur-product');

Route::post('/profile/info/update', 'ProfileController@updateInfo')->name('reparateur-profile-info-update');



Route::post('/reparateur/profile/image/update', [ReparateurController::class, 'updateProfileImage'])->name('reparateur-profile-image-update');

Route::post('/reparateur/update-info', 'App\Http\Controllers\User\ReparateurController@updateInfo')->name('reparateur.updateInfo');


Route::get('/reparateurs', [ReparateurController::class, 'index'])->name('reparateurs.index');
/*fin_réparateurs*/
Route::get('/email', [App\Http\Controllers\EmailController::class, 'create']);
Route::post('/email', [App\Http\Controllers\EmailController::class, 'sendEmail'])->name('send.email');

Route::post('/fetch-states/{id}', [App\Http\Controllers\EmailController::class, 'fetchStates'])->name('fetch.states');

Route::get('email-template/{id}', [EmailController::class, 'show'])->name('requests.show');


Route::post('/fetch-cities/{id}', [App\Http\Controllers\EmailController::class, 'fetchCities'])->name('fetch.cities');

Route::get('/', function () {
    return view('index');
});
Route::get('/index', function () {
    return view('index');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::fallback(function (){
    return redirect()->route('login');
});

Route::get('/boutique', function () {
    return view('backend.boutique.boutique');
})->name('boutique');

Route::get('/rendez_vous', function () {
    return view('bookings.create');
})->name('rendez_vous');

 /*Routes_rendez-vous*/
Route::get('/rendezvous', [RendezvousController::class, 'rendezvous'])->name('rendezvous');
Route::post('/rendezvous', [RendezvousController::class, 'store'])->name('rendezvous.store');

/*fin*/
Route::get('/products', [ProductController::class, 'index']);

require_once __DIR__.'/auth.php';
require_once __DIR__.'/admin.php';
require_once __DIR__.'/vendor.php';
require_once __DIR__.'/profile.php';
require_once __DIR__.'/user.php';
require_once __DIR__.'/brand.php';
require_once __DIR__.'/category.php';
require_once __DIR__.'/sub_category.php';
require_once __DIR__.'/product.php';
require_once __DIR__.'/coupon.php';
require_once __DIR__.'/notifications.php';
require_once __DIR__.'/socialite.php';
require_once __DIR__.'/reparateur.php';
require_once __DIR__.'/client.php';
require_once __DIR__.'/fabricant.php';
require_once __DIR__.'/pannes.php';



