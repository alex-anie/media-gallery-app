<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Media
Route::get('/media', [MediaController::class, 'index'])->name('media.index');
Route::get('/media/create', [MediaController::class, 'create'])->name('media.create'); 
Route::post('/media', [MediaController::class, 'store'])->name('media.store'); 
Route::get('/media/{media}', [MediaController::class, 'show'])->name('media.show');
Route::get('/media/{media}/edit', [MediaController::class,'edit'])->name('media.edit');
Route::post('/media/{media}', [MediaController::class,'update'])->name('media.update');
Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');

//Images
Route::get('/images', [ImagesController::class, 'index'])->name('images.index');
