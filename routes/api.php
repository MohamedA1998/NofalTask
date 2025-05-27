<?php

use App\Http\Controllers\Api\CountriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('countries', CountriesController::class)->only('index', 'show');
