<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/

// for admin
Route::middleware(['auth', 'auth.role:admin'])
    ->prefix('admin')
    ->name('admin-')
    ->controller(ProductController::class)->group(function (){

        Route::view('products', 'backend.product.product_default',
            ['data' => DB::table('get_product_data')->get()])
            ->name('product');
        Route::get('remove_product/{id}', 'productRemove')
            ->whereNumber('id')
            ->name('product-remove');
        Route::get('add_product', 'productAdd')->name('product-add');
        Route::post('create_product', 'productCreate')->name('product-create');
        Route::post('activate_product', 'productActivate')->name('product-activate');

    });

// for vendor
Route::middleware(['auth', 'auth.role:vendor'])
    ->prefix('vendor')
    ->name('vendor-')
    ->controller(ProductController::class)->group(function (){

        Route::get('products', 'getProducts')->name('product');
        Route::get('add_product', 'productAdd')->name('product-add');
        Route::post('create_product', 'productCreate')->name('product-create');
        Route::get('remove_product/{id}', 'productRemove')
            ->whereNumber('id')
            ->name('product-remove');
        Route::get('edit_product/{id}', 'productEdit')
            ->whereNumber('id')->name('product-edit');
        Route::post('update_product/{id}', 'productUpdate')
            ->whereNumber('id')->name('product-update');
        Route::post('activate_product', 'productActivate')->name('product-activate');

    });
    //favorites routes 
    Route::get('product/{product_id}', [ProductController::class, 'show'])->name('view-details');
    Route::post('/favorite', [ProductController::class, 'toggleFavorite'])->name('product.favorite');
    Route::get('/favorites', [ProductController::class, 'showFavorite'])->name('show.favorite')->middleware('auth');
    Route::get('remove_favoris/{id}', [ProductController::class, 'favorisRemove'])
            ->whereNumber('id')
            ->name('favoris-remove');

    //panier routes 
    Route::post('/add-to-cart', [ProductController::class, 'addToCart'])->name('add-to-cart');
    Route::get('/cart', [ProductController::class, 'viewCart'])->name('cart.view');
    Route::delete('/cart', [ProductController::class, 'removeItem'])->name('panier.remove');
    Route::post('/update-cart-quantities', [ProductController::class, 'updateQuantities'])->name('cart.updateQuantities');


    //routes pour la recherche 
    Route::get('/filter-products', [ProductController::class, 'filterProduct'])->name('filter.products');
    //filtrage 
    Route::get('/', [ProductController::class, 'showNewProducts']);
    Route::get('/filter-products-by-brand', 'ProductController@filterProductsByBrand')->name('filter-products-by-brand');
