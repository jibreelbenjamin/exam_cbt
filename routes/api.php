<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PesertaController;
use App\Http\Controllers\API\GuruController;
use App\Http\Controllers\API\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/tes', function (Request $request) {
        return response()->json([
            'status' => true,
            'message' => 'ok',
            'user' => $request->user(),
        ]);
    });

    // Peserta
    Route::get('/peserta', [PesertaController::class, 'index']);
    Route::post('/peserta', [PesertaController::class, 'store']);
    Route::get('/peserta/{id}', [PesertaController::class, 'show']);
    Route::put('/peserta/{id}', [PesertaController::class, 'update']);
    Route::delete('/peserta/{id}', [PesertaController::class, 'destroy']);

    // Guru
    Route::get('/guru', [App\Http\Controllers\API\GuruController::class, 'index']);
    Route::post('/guru', [App\Http\Controllers\API\GuruController::class, 'store']);
    Route::get('/guru/{id}', [App\Http\Controllers\API\GuruController::class, 'show']);
    Route::put('/guru/{id}', [App\Http\Controllers\API\GuruController::class, 'update']);
    Route::delete('/guru/{id}', [App\Http\Controllers\API\GuruController::class, 'destroy']);

    // Admin
    Route::get('/admin', [App\Http\Controllers\API\AdminController::class, 'index']);
    Route::post('/admin', [App\Http\Controllers\API\AdminController::class, 'store']);
    Route::get('/admin/{id}', [App\Http\Controllers\API\AdminController::class, 'show']);
    Route::put('/admin/{id}', [App\Http\Controllers\API\AdminController::class, 'update']);
    Route::delete('/admin/{id}', [App\Http\Controllers\API\AdminController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
