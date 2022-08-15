<?php

use App\Http\Controllers\Api\AuthencateController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:sanctum')->get('/athenticated', function () {
//     return true;
// });

// authentication
Route::post('register',[RegisterController::class, 'store']);
Route::post('login',[AuthencateController::class, 'login']);
Route::post('logout',[AuthencateController::class, 'logout']);

// note
// not set yet to add middleware('auth')
Route::get('notes', [NoteController::class, 'getAll']);

Route::group(['prefix' => 'note'], function() {

    Route::post('/create', [NoteController::class, 'createNote']);
    Route::get('/{id}', [NoteController::class, 'getDetail']);
    Route::put('/update/{id}', [NoteController::class, 'updateNote']);
    Route::delete('/delete/{id}', [NoteController::class, 'deleteNote']);
});

Route::group(['prefix' => 'category'], function() {

    Route::post('/create', [CategoryController::class, 'createCategory']);
    Route::get('/', [CategoryController::class, 'getAllCategory']);
    Route::put('/update/{id}', [CategoryController::class, 'updateCategory']);
    Route::delete('/delete/{id}', [CategoryController::class, 'deleteCategory']);
});


