<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Address\AddressesController;
use App\Http\Controllers\Coupon\CouponsController;
use App\Http\Controllers\Country\CountriesController;
use App\Http\Controllers\User\UsersController;
use App\Http\Controllers\Device\DevicesController;
use App\Http\Controllers\City\CitiesController;


/* |-------------------------------------------------------------------------- | API Routes |-------------------------------------------------------------------------- | | Here is where you can register API routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | is assigned the "api" middleware group. Enjoy building your API! | */

Route::post("/login", [AuthController::class , "login"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class , "me"]);
    Route::get('/logout', [AuthController::class , 'logout']);
 
    //devices
    Route::group(['prefix' => '/devices'], function () {
        Route::get('/', [DevicesController::class , 'index']);
        Route::post('/store', [DevicesController::class , 'store']);
        Route::post('/storeCsv', [DevicesController::class , 'storeCsv']);
        Route::get('/{id}/show', [DevicesController::class , 'show']);
        Route::get('/{id}/edit', [DevicesController::class , 'edit']);
        Route::post('/{id}/update', [DevicesController::class , "update"]);
        Route::delete('/{id}/delete', [DevicesController::class , 'delete']);
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

    //addresses crud
    Route::group(['prefix' => '/addresses'], function () {
        Route::get('/', [AddressesController::class , 'index']);
        Route::post('/store', [AddressesController::class , 'store']);
        Route::get('/{id}/show', [AddressesController::class , 'show']);
        Route::get('/{id}/edit', [AddressesController::class , 'edit']);
        Route::post('/{id}/update', [AddressesController::class , "update"]);
        Route::delete('/{id}/delete', [AddressesController::class , 'delete']);
    });

    //cities crud
    Route::group(['prefix' => '/cities'], function () {
        Route::get('/', [CitiesController::class , 'index']);
        Route::post('/store', [CitiesController::class , 'store']);
        Route::get('/{id}/show', [CitiesController::class , 'show']);
        Route::get('/{id}/edit', [CitiesController::class , 'edit']);
        Route::post('/{id}/update', [CitiesController::class , "update"]);
        Route::delete('/{id}/delete', [CitiesController::class , 'delete']);
    });  

    //coupons crud
    Route::group(['prefix' => '/coupons'], function () {
        Route::get('/', [CouponsController::class , 'index']);
        Route::post('/store', [CouponsController::class , 'store']);
        Route::get('/{id}/show', [CouponsController::class , 'show']);
        Route::get('/{id}/edit', [CouponsController::class , 'edit']);
        Route::post('/{id}/update', [CouponsController::class , "update"]);
        Route::delete('/{id}/delete', [CouponsController::class , 'delete']);
    });
    //countries crud
    Route::group(['prefix' => '/countries'], function () {
        Route::get('/', [CountriesController::class , 'index']);
        Route::post('/store', [CountriesController::class , 'store']);
        Route::get('/{id}/show', [CountriesController::class , 'show']);
        Route::get('/{id}/edit', [CountriesController::class , 'edit']);
        Route::post('/{id}/update', [CountriesController::class , "update"]);
        Route::delete('/{id}/delete', [CountriesController::class , 'delete']);
    });
});
