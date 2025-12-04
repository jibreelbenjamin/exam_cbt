<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\api\KelasController;
use App\Http\Controllers\api\PaketSoalController;
use App\Http\Controllers\API\PesertaController;
use App\Http\Controllers\API\GuruController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\api\RuanganController;
use App\Http\Controllers\api\SoalController;
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

    // Soal
    Route::get('/soal', [SoalController::class, 'index']);
    Route::post('/soal', [SoalController::class, 'store']);
    Route::get('/soal/{id}', [SoalController::class, 'show']);
    Route::put('/soal/{id}', [SoalController::class, 'update']);
    Route::delete('/soal/{id}', [SoalController::class, 'destroy']);

    // Paket Soal
    Route::get('/paket-soal', [PaketSoalController::class, 'index']);
    Route::post('/paket-soal', [PaketSoalController::class, 'store']);
    Route::get('/paket-soal/{id}', [PaketSoalController::class, 'show']);
    Route::put('/paket-soal/{id}', [PaketSoalController::class, 'update']);
    Route::delete('/paket-soal/{id}', [PaketSoalController::class, 'destroy']);

    // Ruangan
    Route::get('/ruangan', [RuanganController::class, 'index']);
    Route::post('/ruangan', [RuanganController::class, 'store']);
    Route::get('/ruangan/{id}', [RuanganController::class, 'show']);
    Route::put('/ruangan/{id}', [RuanganController::class, 'update']);
    Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy']);

    // Kelas
    Route::get('/kelas', [KelasController::class, 'index']);
    Route::post('/kelas', [KelasController::class, 'store']);
    Route::get('/kelas/{id}', [KelasController::class, 'show']);
    Route::put('/kelas/{id}', [KelasController::class, 'update']);
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
