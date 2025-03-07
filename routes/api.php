<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FrontController;
use App\Http\Controllers\Api\Admin\AdminEmpresaController;
use App\Http\Controllers\Api\Admin\AdminCategoriaController;
use App\Http\Controllers\Api\Admin\AdminUserController;
use App\Http\Controllers\Api\Client\EmpresaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // PUBLIC ROUTES
    Route::get('/public/{slug}', [FrontController::class, 'categoria']);
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);
    
    // PROTECTED ROUTES
    Route::middleware('auth:sanctum')->group(function () {
        // Auth
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        
        // Clients
        Route::apiResource('/client/empresa', EmpresaController::class);
        
        // Admins
        Route::apiResource('/admin/user', AdminUserController::class);
        Route::apiResource('/admin/categoria', AdminCategoriaController::class);
        Route::apiResource('/admin/empresa', AdminEmpresaController::class);
    });
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
