<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\listeReparateurController;
use App\Http\Controllers\RendezvousController;
use App\Http\Controllers\PanneController;

use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\demandeController;
use App\Http\Controllers\User\ReparateurController;
use App\Http\Controllers\CommentController;




use App\Http\Controllers\cvController;



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



// routes/web.php
Route::get('/reparateur/{id}/comments', [CommentController::class, 'showComments'])->name('comments.show');





Route::post('/comments/store', [CvController::class, 'store']);

Route::get('/reparateur1/{id}', [CvController::class, 'showProfile'])->name('reparateur.showProfile');


Route::post('/reparateur1', [ReparateurController::class, 'store'])->name('reparateurs.store');
Route::get('/reparateurs', [listeReparateurController::class, 'index'])->name('reparateurs.index');

Route::get('/demandes-recentes', 'App\Http\Controllers\demandeControllrs@demandesRecentes')->name('demandes.recentes');


Route::get('/demandes-recentes', [demandeController::class, 'index'])->name('demandes.recentes');


/*demande des clients*/

Route::get('/demandes', [DemandeController::class, 'index'])->name('demandes.index');
Route::get('/demandes/{id}/edit', [DemandeController::class, 'edit'])->name('demandes.edit');
Route::put('/demandes/{id}', [DemandeController::class, 'update'])->name('demandes.update');
 

 
 

Route::get('/fetch-states/{marqueID}', [DemandeController::class, 'fetchStates']);
Route::get('/fetch-cities/{typepID}', [DemandeController::class, 'fetchCities']);

 // Nouvelle route pour les pannes
Route::delete('/demandes/{id}', [DemandeController::class, 'destroy'])->name('demandes.destroy');
Route::resource('demandes', DemandeController::class);
/*fin demandes des clients*/

Route::post('/comments/store', [CvController::class, 'storeComment'])->name('comments.store');

Route::get('/chatbot1', function () {
    return view('chatbot.chatbot');
  });


  Route::post('/get-message', [ChatbotController::class, 'getMessage'])->name('get-message');
  Route::get('/get-queries', [ChatbotController::class, 'getQueries'])->name('get-queries');
  


  Route::get('/liste-des-pannes', [PanneController::class, 'index'])->name('listepannes');
/*fin_chatbot */

/*réparateurs*/
Route::get('/reparateur-product', 'ProductController@reparateurProduct')->name('reparateur-product');

Route::post('/profile/info/update', 'ProfileController@updateInfo')->name('reparateur-profile-info-update');



Route::post('/reparateur/profile/image/update', [ReparateurController::class, 'updateProfileImage'])->name('reparateur-profile-image-update');

Route::post('/reparateur/update-info', 'App\Http\Controllers\User\ReparateurController@updateInfo')->name('reparateur.updateInfo');



Route::post('/rendezvous/create/{id}', [RendezvousController::class, 'store'])->name('rendezvous.store');
Route::get('/bookings/create', [RendezvousController::class, 'rendezvous'])->name('bookings.create');
//Route::put('/rendezvous/{id}', [RendezvousController::class, 'store'])->name('rendezvous.store');


/*fin_réparateurs*/


/*emails sending ..*/
Route::post('/contact', [App\Http\Controllers\EmailController::class, 'sendContact'])->name('send.contact');

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
/*****************************Boutique*********************************** */
Route::get('/boutique', function () {
    return view('backend.boutique.boutique');
})->name('boutique');

Route::get('/contactUs', function () {
    return view('contactUs');
})->name('contactUs');




/*Routes_rendez-vous*/
Route::get('/rendez_vous', function () {
    return view('bookings.create');
})->name('rendez_vous');


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



