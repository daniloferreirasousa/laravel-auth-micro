<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\PermissionUserController;


/**
 * Auth and Register Routes
 */
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/users/can/{permission}', [PermissionUserController::class, 'userHasPermission']);
    Route::post('/users/permissions', [PermissionUserController::class, 'addPermissionUser']);
    Route::delete('/users/permissions', [PermissionUserController::class, 'removePermissionUser'])->middleware('can:deletar_permissao_usuario');

    Route::get('/users/{identify}/permissions', [PermissionUserController::class, 'permissionUser']);

    Route::get('/resources', [ResourceController::class, 'index']);

    Route::apiResource('/users', UserController::class);
});

Route::get('/', function () {
    return response()->json(['message' => 'Ok']);
});
