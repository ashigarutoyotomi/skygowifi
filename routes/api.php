<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UsersController;

/* |-------------------------------------------------------------------------- | API Routes |-------------------------------------------------------------------------- | | Here is where you can register API routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | is assigned the "api" middleware group. Enjoy building your API! | */
Route::post("/login", [AuthController::class , "login"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class , "me"]);
    Route::get('/logout', [AuthController::class , 'logout']);
    
    
});

//users crud    
Route::group(['prefix' => '/users'], function () {
    Route::get('/', [UsersController::class , 'index']);
    Route::post('/store', [UsersController::class , 'store']);
    Route::get('/{id}/show', [UsersController::class , 'show']);
    Route::get('/{id}/edit', [UsersController::class , 'edit']);
    Route::post('/{id}/update', [UsersController::class , "update"]);
    Route::delete('/{id}/delete', [UsersController::class , 'delete']);        
});