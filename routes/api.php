<?php

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

Route::apiResource('/users', \App\Http\Controllers\Api\UserController::class);

Route::get('/users/{id}/phones', [\App\Http\Controllers\Api\PhoneController::class, 'index']);
Route::post('/users/phone', [\App\Http\Controllers\Api\PhoneController::class, 'store']);
Route::put('/users/phone/{id}', [\App\Http\Controllers\Api\PhoneController::class, 'update']);
Route::delete('/users/phone/{id}', [\App\Http\Controllers\Api\PhoneController::class, 'destroy']);
