<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/create', [BlogController::class, 'create'])->name('blogs.create');
Route::post('/addblog', [BlogController::class, 'store'])->name('blogs.store');
Route::get('blog/{id}', [BlogController::class, 'show'])->name('lire-plus');

Route::get('/searchblog', [BlogController::class, 'search'])->name('searchblog');
