<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlaceController;
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


Route::middleware('auth:sanctum')->apiResource('places', PlaceController::class);
Route::controller(AuthController::class)
    ->prefix('auth')
    ->as('auth.')
    ->middleware('api')
    ->group(function () {
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout')->middleware('auth:sanctum');
    });

