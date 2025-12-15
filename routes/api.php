<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\api\KelasController;
use App\Http\Controllers\api\PaketSoalController;
use App\Http\Controllers\api\AksesPaketSoalController;
use App\Http\Controllers\API\PesertaController;
use App\Http\Controllers\API\GuruController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\api\RuanganController;
use App\Http\Controllers\api\SoalController;
use App\Http\Controllers\api\PilihanJawabanController;
use App\Http\Controllers\api\TokenController;
use App\Http\Controllers\api\UjianController;
use App\Http\Controllers\api\PaketUjianController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/kelas/select', [KelasController::class, 'search']);
Route::get('/ruangan/select', [RuanganController::class, 'search']);
Route::get('/guru/select', [GuruController::class, 'search']);
Route::get('/paket-soal/select', [PaketSoalController::class, 'search']);
Route::get('/paket-ujian/select', [PaketUjianController::class, 'search']);

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

    // Pilihan Jawaban
    Route::get('/pilihan-jawaban/{id}', [PilihanJawabanController::class, 'index']);
    Route::post('/pilihan-jawaban', [PilihanJawabanController::class, 'store']);
    Route::get('/pilihan-jawaban/detail/{id}', [PilihanJawabanController::class, 'show']);
    Route::put('/pilihan-jawaban/{id}', [PilihanJawabanController::class, 'update']);
    Route::delete('/pilihan-jawaban/{id}', [PilihanJawabanController::class, 'destroy']);

    // Akses Paket Soal
    Route::get('/akses-paket-soal', [AksesPaketSoalController::class, 'index']);
    Route::post('/akses-paket-soal', [AksesPaketSoalController::class, 'store']);
    Route::get('/akses-paket-soal/{id}', [AksesPaketSoalController::class, 'show']);
    Route::put('/akses-paket-soal/{id}', [AksesPaketSoalController::class, 'update']);
    Route::delete('/akses-paket-soal/{id}', [AksesPaketSoalController::class, 'destroy']);

    // Ujian
    Route::get('/ujian', [UjianController::class, 'index']);
    Route::post('/ujian', [UjianController::class, 'store']);
    Route::get('/ujian/{id}', [UjianController::class, 'show']);
    Route::put('/ujian/{id}', [UjianController::class, 'update']);
    Route::delete('/ujian/{id}', [UjianController::class, 'destroy']);

    // Paket Ujian
    Route::get('/paket-ujian', [PaketUjianController::class, 'index']);
    Route::post('/paket-ujian', [PaketUjianController::class, 'store']);
    Route::get('/paket-ujian/{id}', [PaketUjianController::class, 'show']);
    Route::put('/paket-ujian/{id}', [PaketUjianController::class, 'update']);
    Route::delete('/paket-ujian/{id}', [PaketUjianController::class, 'destroy']);

    // Token
    Route::get('/token', [TokenController::class, 'index']);
    Route::post('/token', [TokenController::class, 'store']);
    Route::get('/token/{id}', [TokenController::class, 'show']);
    Route::put('/token/{id}', [TokenController::class, 'update']);
    Route::delete('/token/{id}', [TokenController::class, 'destroy']);

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
