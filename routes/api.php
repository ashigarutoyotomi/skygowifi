<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressesController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\CitiesController;
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

//countries
Route::group(['prefix' => 'countries'], function () {
    Route::get('/', [CountriesController::class, 'index']);
    Route::post('/store', [CountriesController::class, 'store']);
    Route::post('/{id}/update', [CountriesController::class, 'update']);
    Route::get('/{id}/show', [CountriesController::class, 'show']);
    Route::get('/{id}/edit', [CountriesController::class, 'edit']);
    Route::delete('/{id}/delete', [CountriesController::class, 'delete']);
});

//cities
Route::group(['prefix' => 'cities'], function () {
    Route::get('/', [CitiesController::class, 'index']);
    Route::post('/store', [CitiesController::class, 'store']);
    Route::post('/{id}/update', [CitiesController::class, 'update']);
    Route::get('/{id}/show', [CitiesController::class, 'show']);
    Route::get('/{id}/edit', [CitiesController::class, 'edit']);
    Route::delete('/{id}/delete', [CitiesController::class, 'delete']);
});