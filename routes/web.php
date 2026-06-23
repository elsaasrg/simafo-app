<?php

use App\Http\Controllers\AduanController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\BeasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\InfoBeasiswaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InfoLombaController;
use App\Http\Controllers\KonselingController;
use App\Http\Controllers\MitraJurusanController;
use App\Http\Controllers\PengajuanSuratController;
use App\Http\Controllers\ReferensiTempatKpController;
use App\Http\Controllers\TempatKpController;
use App\Http\Controllers\TracerStudyController;
use App\Http\Controllers\ValidasiSuratController;
use App\Models\MitraJurusan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// BLOK 1: RUTE UMUM


// BLOK 2 : BISA DIAKSES SEMUA ROLE YG LOGIN
Route::middleware(['auth'])->group(function () {
    Route::resource('aktivitas', AktivitasController::class);
    Route::resource('organisasi', OrganisasiController::class);
    Route::resource('beasiswa', BeasiswaController::class);
    Route::resource('info-lomba', InfoLombaController::class);
    Route::resource('info-beasiswa', InfoBeasiswaController::class);
    Route::resource('pengajuan-surat', PengajuanSuratController::class);
    Route::resource('konseling', KonselingController::class);
    Route::resource('aduan', AduanController::class);
    Route::resource('tracer-study', TracerStudyController::class);
    Route::get('/referensi-tempat-kp', [ReferensiTempatKpController::class, 'index'])->name('referensi.kp');
});

// BLOK 3: ADMIN
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('dosen', DosenController::class);
    Route::resource('mitra-jurusan', MitraJurusanController::class);
    Route::resource('tempat-kp', TempatKpController::class);
    Route::get('/cetak', [AktivitasController::class, 'cetak'])->name('aktivitas.cetak');
    Route::put('/organisasi/{organisasi}/update-status-validasi', [OrganisasiController::class, 'updateStatusValidasi'])->name('organisasi.updateStatusValidasi');
    Route::put('/beasiswa/{beasiswa}/update-status', [BeasiswaController::class, 'updateStatus'])->name('beasiswa.updateStatus');
    Route::put('/pengajuan-surat/{id}/update-status', [ValidasiSuratController::class, 'updateStatus'])->name('pengajuan-surat.updateStatus');
    Route::put('/pengajuan-surat/{id}/update-status', [ValidasiSuratController::class, 'updateStatus'])->name('pengajuan-surat.updateStatus');
});


// BLOK 4 : KAJUR
Route::middleware(['auth', 'role:Kajur'])->group(function () {
    Route::get('/cetak', [AktivitasController::class, 'cetak'])->name('aktivitas.cetak');
    Route::put('/aduan/{id}/update-status', [AduanController::class, 'updateStatus'])->name('aduan.updateStatus');
});

// BLOK 5 : DOSEN KEMAHASISWAAN


// BLOK 6 : DOSEN


// BLOK 7 : MAHASISWA


// BLOK 8 : ALUMNI
