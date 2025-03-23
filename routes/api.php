<?php

use App\Http\Controllers\API\MoviesController;
use App\Http\Controllers\API\ScreeningsController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('screenings/{screening}/movie', [ScreeningsController::class, 'movie']);
    Route::apiResource('movies', MoviesController::class);

    Route::get('movies/{movie}/screenings', [MoviesController::class, 'screenings']);
    Route::apiResource('screenings', ScreeningsController::class);

    Route::post('logout', [AuthController::class, 'logout']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

