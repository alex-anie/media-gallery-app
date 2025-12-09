<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

//Home
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware('auth')->controller(Dashboard::class)->group(function(){
    //Dashboard
    Route::get('/dashboard/all-media-type',  'showAllMediaType')->name('dashboard.showAllMediaType');
    Route::get('/dashboard/users',  'showUsers')->name('dashboard.showUsers');
    Route::get('/dashboard/users/{user}/edit',  'editUser')->name('dashboard.editUser');
    Route::post('/dashboard/users/{user}',  'updateUser')->name('dashboard.updateUser');
    Route::delete('/dashboard/users/{user}',  'destroyUser')->name('dashboard.destroy');
});

// Media
Route::get('/media', [MediaController::class, 'index'])->name('media.index');
Route::get('/media/create', [MediaController::class, 'create'])->name('media.create'); 
Route::post('/media', [MediaController::class, 'store'])->name('media.store'); 
Route::get('/media/{media}', [MediaController::class, 'show'])->name('media.show');
Route::get('/media/{media}/edit', [MediaController::class,'edit'])->name('media.edit');
Route::post('/media/{media}', [MediaController::class,'update'])->name('media.update');
Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');

//MIME TYPE ROUTES
Route::get('/images', [ImagesController::class, 'index'])->name('images.index');
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/music', [MusicController::class, 'index'])->name('music.index');
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');

//Auth
Route::get('/login', [UserController::class, 'showLogin'])->name('user.showLogin')->middleware('guest');
Route::get('/register', [UserController::class, 'showRegister'])->name('user.showRegistration')->middleware('guest');
Route::post('/register', [UserController::class, 'register'])->name('user.register')->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->name('user.login')->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout')->middleware('auth');

