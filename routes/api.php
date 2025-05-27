<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
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

// Reset Password
Route::controller(ResetPasswordController::class)->group(function(){
    Route::post('send-reset-phone-password', 'sendResetPhonePassword');
    Route::post('reset-password', 'resetPassword');
});


Route::apiResource('countries', CountriesController::class)->only('index', 'show');


