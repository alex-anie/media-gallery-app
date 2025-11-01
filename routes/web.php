<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/media', [MediaController::class, 'index'])->name('media.index');
Route::get('/media/create', [MediaController::class, 'create'])->name('media.create'); 
Route::post('/media', [MediaController::class, 'store'])->name('media.store'); 
Route::get('/media/{media}', [MediaController::class, 'show'])->name('media.show');

