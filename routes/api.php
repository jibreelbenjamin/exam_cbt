<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\JawabanSiswaController;
use App\Http\Controllers\API\MapelController;
use App\Http\Controllers\API\PilihanJawabanController;
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

    // Mapel
    Route::get('/mapel', [MapelController::class, 'index']);
    Route::post('/mapel', [MapelController::class, 'store']);
    Route::get('/mapel/{id}', [MapelController::class, 'show']);
    Route::put('/mapel/{id}', [MapelController::class, 'update']);
    Route::delete('/mapel/{id}', [MapelController::class, 'destroy']);

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

    Route::post('/logout', [AuthController::class, 'logout']);
});

