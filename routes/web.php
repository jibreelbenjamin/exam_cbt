<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeOperatorController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaketSoalController;
use App\Http\Controllers\AksesPaketSoalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\UjianController;

Route::get('/', function () { return redirect()->route('dashboard.redirect'); })->name('root');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/operator/login', [AuthController::class, 'loginFormOperator'])->name('operator.login.form');
Route::post('/operator/login', [AuthController::class, 'loginOperator'])->name('operator.login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// universal redirect
Route::get('/redirect/dashboard', function () {
    if (Auth::guard('peserta')->check()) {
        return redirect()->route('home');
    }
    if (Auth::guard('admin')->check() || Auth::guard('guru')->check()) {
        return redirect()->route('operator.home');
    }

    return redirect()->route('login.form');
})->name('dashboard.redirect');

Route::middleware('auth_web:peserta')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'home'])->name('home');
});

Route::middleware('auth_web:admin,guru')->group(function () {
    Route::get('/operator/invalid', function (Request $request) {
        return redirect()->route('operator.home')->with('warningToast', 'Sedang dalam pengembangan');
    })->name('operator.invalid');

    Route::get('/operator', function () { return redirect()->route('operator.home'); });
    Route::get('/operator/dashboard', [HomeOperatorController::class, 'home'])->name('operator.home');

    Route::get('/operator/ruangan', [RuanganController::class, 'index'])->name('operator.ruangan');
    Route::get('/operator/ruangan/load', [RuanganController::class, 'loadData'])->name('operator.ruangan.load');
    Route::get('/operator/ruangan/create', [RuanganController::class, 'create'])->name('operator.ruangan.create');
    Route::get('/operator/ruangan/{id}', [RuanganController::class, 'setting'])->name('operator.ruangan.setting');
    Route::post('/operator/ruangan/add', [RuanganController::class, 'add'])->name('operator.ruangan.create.action');
    Route::put('/operator/ruangan/update/{id}', [RuanganController::class, 'update'])->name('operator.ruangan.update.action');
    Route::delete('/operator/ruangan/delete/{id}', [RuanganController::class, 'delete'])->name('operator.ruangan.delete.action');

    Route::get('/operator/kelas', [KelasController::class, 'index'])->name('operator.kelas');
    Route::get('/operator/kelas/load', [KelasController::class, 'loadData'])->name('operator.kelas.load');
    Route::get('/operator/kelas/create', [KelasController::class, 'create'])->name('operator.kelas.create');
    Route::get('/operator/kelas/{id}', [KelasController::class, 'setting'])->name('operator.kelas.setting');
    Route::post('/operator/kelas/add', [KelasController::class, 'add'])->name('operator.kelas.create.action');
    Route::put('/operator/kelas/update/{id}', [KelasController::class, 'update'])->name('operator.kelas.update.action');
    Route::delete('/operator/kelas/delete/{id}', [KelasController::class, 'delete'])->name('operator.kelas.delete.action');

    Route::get('/operator/paket-soal', [PaketSoalController::class, 'index'])->name('operator.paket-soal');
    Route::get('/operator/paket-soal/load', [PaketSoalController::class, 'loadData'])->name('operator.paket-soal.load');
    Route::get('/operator/paket-soal/create', [PaketSoalController::class, 'create'])->name('operator.paket-soal.create');
    Route::get('/operator/paket-soal/{id}', [PaketSoalController::class, 'setting'])->name('operator.paket-soal.setting');
    Route::post('/operator/paket-soal/add', [PaketSoalController::class, 'add'])->name('operator.paket-soal.create.action');
    Route::put('/operator/paket-soal/update/{id}', [PaketSoalController::class, 'update'])->name('operator.paket-soal.update.action');
    Route::delete('/operator/paket-soal/delete/{id}', [PaketSoalController::class, 'delete'])->name('operator.paket-soal.delete.action');

    Route::post('/operator/akses-paket-soal/add', [AksesPaketSoalController::class, 'add'])->name('operator.akses-paket-soal.create.action');
    Route::delete('/operator/akses-paket-soal/delete/{id}', [AksesPaketSoalController::class, 'delete'])->name('operator.akses-paket-soal.delete.action');

    Route::get('/operator/peserta', [PesertaController::class, 'index'])->name('operator.peserta');
    Route::get('/operator/peserta/load', [PesertaController::class, 'loadData'])->name('operator.peserta.load');
    Route::get('/operator/peserta/create', [PesertaController::class, 'create'])->name('operator.peserta.create');
    Route::get('/operator/peserta/{id}', [PesertaController::class, 'setting'])->name('operator.peserta.setting');
    Route::post('/operator/peserta/add', [PesertaController::class, 'add'])->name('operator.peserta.create.action');
    Route::put('/operator/peserta/update/{id}', [PesertaController::class, 'update'])->name('operator.peserta.update.action');
    Route::delete('/operator/peserta/delete/{id}', [PesertaController::class, 'delete'])->name('operator.peserta.delete.action');

    Route::get('/operator/guru', [GuruController::class, 'index'])->name('operator.guru');
    Route::get('/operator/guru/load', [GuruController::class, 'loadData'])->name('operator.guru.load');
    Route::get('/operator/guru/create', [GuruController::class, 'create'])->name('operator.guru.create');
    Route::get('/operator/guru/{id}', [GuruController::class, 'setting'])->name('operator.guru.setting');
    Route::post('/operator/guru/add', [GuruController::class, 'add'])->name('operator.guru.create.action');
    Route::put('/operator/guru/update/{id}', [GuruController::class, 'update'])->name('operator.guru.update.action');
    Route::put('/operator/guru/update/{id}/password', [GuruController::class, 'updatePassword'])->name('operator.guru.update-password.action');
    Route::put('/operator/guru/update/{id}/reset-password', [GuruController::class, 'resetPassword'])->name('operator.guru.reset-password.action');
    Route::delete('/operator/guru/delete/{id}', [GuruController::class, 'delete'])->name('operator.guru.delete.action');

    Route::get('/operator/admin', [AdminController::class, 'index'])->name('operator.admin');
    Route::get('/operator/admin/load', [AdminController::class, 'loadData'])->name('operator.admin.load');
    Route::get('/operator/admin/create', [AdminController::class, 'create'])->name('operator.admin.create');
    Route::get('/operator/admin/{id}', [AdminController::class, 'setting'])->name('operator.admin.setting');
    Route::post('/operator/admin/add', [AdminController::class, 'add'])->name('operator.admin.create.action');
    Route::put('/operator/admin/update/{id}', [AdminController::class, 'update'])->name('operator.admin.update.action');
    Route::put('/operator/admin/update/{id}/password', [AdminController::class, 'updatePassword'])->name('operator.admin.update-password.action');
    Route::put('/operator/admin/update/{id}/reset-password', [AdminController::class, 'resetPassword'])->name('operator.admin.reset-password.action');
    Route::delete('/operator/admin/delete/{id}', [AdminController::class, 'delete'])->name('operator.admin.delete.action');

    Route::get('/operator/ujian', [UjianController::class, 'index'])->name('operator.ujian');
    Route::get('/operator/ujian/load', [UjianController::class, 'loadData'])->name('operator.ujian.load');
    Route::get('/operator/ujian/create', [UjianController::class, 'create'])->name('operator.ujian.create');
    Route::get('/operator/ujian/{id}', [UjianController::class, 'setting'])->name('operator.ujian.setting');
    Route::post('/operator/ujian/add', [UjianController::class, 'add'])->name('operator.ujian.create.action');
    Route::put('/operator/ujian/update/{id}', [UjianController::class, 'update'])->name('operator.ujian.update.action');
    Route::delete('/operator/ujian/delete/{id}', [UjianController::class, 'delete'])->name('operator.ujian.delete.action');

    Route::get('/operator/peserta', [PesertaController::class, 'index'])->name('operator.peserta');
    Route::get('/operator/peserta/load', [PesertaController::class, 'loadData'])->name('operator.peserta.load');
    Route::get('/operator/peserta/create', [PesertaController::class, 'create'])->name('operator.peserta.create');
    Route::get('/operator/peserta/{id}', [PesertaController::class, 'setting'])->name('operator.peserta.setting');
    Route::post('/operator/peserta/add', [PesertaController::class, 'add'])->name('operator.peserta.create.action');
    Route::put('/operator/peserta/update/{id}', [PesertaController::class, 'update'])->name('operator.peserta.update.action');
    Route::delete('/operator/peserta/delete/{id}', [PesertaController::class, 'delete'])->name('operator.peserta.delete.action');
});