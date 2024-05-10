<?php 
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PannesController;
use App\Models\Typepanne;

Route::middleware(['auth'])->controller(PannesController::class)->group(function (){
    Route::get('add_pannes', 'PannesController@pannesAdd');
    Route::view('add_pannes', 'backend.pannes.pannes_add')->name('pannes-add');
    Route::post('create_panne', [PannesController::class, 'store'])->name('panne.create');

});


?>