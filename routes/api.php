<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\JawabanSiswaController;
use App\Http\Controllers\API\KelasController;
use App\Http\Controllers\API\PaketSoalController;
use App\Http\Controllers\API\PilihanJawabanController;
use App\Http\Controllers\API\RuanganController;
use App\Http\Controllers\API\SoalController;
use App\Http\Controllers\API\UjianController;
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

    // Paket Soal
    Route::get('/paket-soal', [PaketSoalController::class, 'index']);
    Route::post('/paket-soal', [PaketSoalController::class, 'store']);
    Route::get('/paket-soal/{id}', [PaketSoalController::class, 'show']);
    Route::put('/paket-soal/{id}', [PaketSoalController::class, 'update']);
    Route::delete('/paket-soal/{id}', [PaketSoalController::class, 'destroy']);

    // Soal
    Route::get('/soal', [SoalController::class, 'index']);
    Route::post('/soal', [SoalController::class, 'store']);
    Route::get('/soal/{id}', [SoalController::class, 'show']);
    Route::put('/soal/{id}', [SoalController::class, 'update']);
    Route::delete('/soal/{id}', [SoalController::class, 'destroy']);

    // Jawaban Siswa
    Route::get('/jawaban-siswa', [JawabanSiswaController::class, 'index']);
    Route::get('/jawaban-siswa/{id}', [JawabanSiswaController::class, 'show']);
    Route::post('/jawaban-siswa', [JawabanSiswaController::class, 'store']);
    Route::put('/jawaban-siswa/{id}', [JawabanSiswaController::class, 'update']);
    Route::delete('/jawaban-siswa/{id}', [JawabanSiswaController::class, 'destroy']);

    // Pilihan Jawaban
    Route::get('/pilihan-jawaban/{id}', [PilihanJawabanController::class, 'index']);
    Route::post('/pilihan-jawaban', [PilihanJawabanController::class, 'store']);
    Route::get('/pilihan-jawaban/detail/{id}', [PilihanJawabanController::class, 'show']);
    Route::put('/pilihan-jawaban/{id}', [PilihanJawabanController::class, 'update']);
    Route::delete('/pilihan-jawaban/{id}', [PilihanJawabanController::class, 'destroy']);

    // Ujian
    Route::get('/ujian', [UjianController::class, 'index']);
    Route::post('/ujian', [UjianController::class, 'store']);
    Route::get('/ujian/{id}', [UjianController::class, 'show']);
    Route::put('/ujian/{id}', [UjianController::class, 'update']);
    Route::delete('/ujian/{id}', [UjianController::class, 'destroy']);

    // Kelas
    Route::get('/kelas', [KelasController::class, 'index']);
    Route::post('/kelas', [KelasController::class, 'store']);
    Route::get('/kelas/{id}', [KelasController::class, 'show']);
    Route::put('/kelas/{id}', [KelasController::class, 'update']);
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy']);
    
    // Ruangan
    Route::get('/ruangan', [RuanganController::class, 'index']);
    Route::post('/ruangan', [RuanganController::class, 'store']);
    Route::get('/ruangan/{id}', [RuanganController::class, 'show']);
    Route::put('/ruangan/{id}', [RuanganController::class, 'update']);
    Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

