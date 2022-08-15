<?php

use App\Http\Controllers\Api\AuthencateController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// authentication
Route::post('register',[RegisterController::class, 'store']);
Route::post('login',[AuthencateController::class, 'login']);


// note
// not set yet to add middleware('auth')
Route::get('notes', [NoteController::class, 'getAll']);
Route::get('categories', [CategoryController::class, 'getAllCategory']);



Route::group(['middleware' => ['jwt.verify']], function() {

    // Get User
     Route::get('user', [AuthencateController::class, 'getUser']);

    // logout
    Route::get('logout',[AuthencateController::class, 'logout']);


    Route::group(['prefix' => 'note'], function() {
        Route::post('/create', [NoteController::class, 'createNote']);
        Route::get('/{id}', [NoteController::class, 'getDetail']);
        Route::put('/update/{id}', [NoteController::class, 'updateNote']);
        Route::delete('/delete/{id}', [NoteController::class, 'deleteNote']);
    });

    Route::group(['prefix' => 'category'], function() {
        Route::post('/create', [CategoryController::class, 'createCategory']);
        Route::get('/{id}', [CategoryController::class, 'getCategoryById']);
        Route::put('/update/{id}', [CategoryController::class, 'updateCategory']);
        Route::delete('/delete/{id}', [CategoryController::class, 'deleteCategory']);
    });

});
