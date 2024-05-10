<?php

use App\Http\Controllers\BrandController;
use App\Models\BrandModel;
use App\Models\Marque;
use App\Http\Controllers\MarqueController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Brand Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->controller(BrandController::class)->group(function (){
        Route::view('brands', 'backend.brand.brand_default', ['data' => BrandModel::all()])->name('brand');
        Route::view('add_brand', 'backend.brand.brand_add')->name('brand-add');
        Route::post('create_brand', 'brandCreate')->name('brand-create');
        Route::get('remove_brand/{id}', 'brandRemove')->name('brand-remove')->whereNumber('id');
        Route::post('update_brand', 'brandUpdate')->name('brand-update');
    });

    Route::middleware(['auth'])->controller(MarqueController::class)->group(function (){
        Route::view('add_marque', 'backend.marque.marque_add')->name('marque-add');
        Route::post('create_marque', [MarqueController::class, 'store'])->name('marque.create');
        Route::get('marques', [MarqueController::class, 'show'])->name('marques.show');
        Route::post('update_marque', 'marqueUpdate')->name('marque-update');
        Route::get('remove_marque/{id}', [MarqueController::class, 'marqueRemove'])
        ->name('marque_remove')->whereNumber('id');


    });
