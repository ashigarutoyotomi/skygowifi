<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressesController;
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

Route::middleware('auth:sanctum')->group(function(){

});

//addresses
Route::group(['prefix' => 'addresses'], function () {
    Route::get('/', [AddressesController::class, 'index']);
    Route::post('/store', [AddressesController::class, 'store']);
    Route::post('/{id}/update', [AddressesController::class, 'update']);
    Route::get('/{id}/show', [AddressesController::class, 'show']);
    Route::get('/{id}/edit', [AddressesController::class, 'edit']);
    Route::delete('/{id}/delete', [AddressesController::class, 'delete']);
});

//addresses
Route::group(['prefix' => 'countries'], function () {
    Route::get('/', [AddressesController::class, 'index']);
    Route::post('/store', [AddressesController::class, 'store']);
    Route::post('/{id}/update', [AddressesController::class, 'update']);
    Route::get('/{id}/show', [AddressesController::class, 'show']);
    Route::get('/{id}/edit', [AddressesController::class, 'edit']);
    Route::delete('/{id}/delete', [AddressesController::class, 'delete']);
});

//addresses
Route::group(['prefix' => 'cities'], function () {
    Route::get('/', [AddressesController::class, 'index']);
    Route::post('/store', [AddressesController::class, 'store']);
    Route::post('/{id}/update', [AddressesController::class, 'update']);
    Route::get('/{id}/show', [AddressesController::class, 'show']);
    Route::get('/{id}/edit', [AddressesController::class, 'edit']);
    Route::delete('/{id}/delete', [AddressesController::class, 'delete']);
});