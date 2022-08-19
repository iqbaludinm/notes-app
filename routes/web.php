<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
    'home' => false
]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'dashboard','middleware' => ['web','auth']] , function() {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // users
    Route::get('/users', [DashboardController::class, 'userall'])->name('users.index');
    Route::get('/user/detail/{id}', [DashboardController::class, 'userhow'])->name('users.detail');
    // notes
    Route::get('/notes', [DashboardController::class, 'notesll'])->name('notes.index');
    // categories
    Route::get('/categories', [DashboardController::class, 'categoryll'])->name('categories.index');


    Route::resource('/profile',ProfileController::class)->except('show','create','destroy','store','edit');


});

