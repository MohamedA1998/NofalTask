<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CountriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(RegisterController::class)->group(function(){
    Route::post('register' ,'store');
    Route::post('verify-otp', 'verifyAccount');
});

Route::controller(AuthController::class)->group(function(){
    Route::post('login' , 'store');
    Route::post('logout' ,'destroy');
});


Route::apiResource('countries', CountriesController::class)->only('index', 'show');


