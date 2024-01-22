<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\RegisterController;


/**
 * Auth and Register Routes
 */

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/users', UserController::class);
});

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/auth', [AuthController::class, 'auth']);

Route::get('/', function () {
    return response()->json(['message' => 'Ok']);
});
