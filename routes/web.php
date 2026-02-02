<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KerusakanGedungController;
use App\Http\Controllers\PemesananRuangRapatController;
use App\Http\Controllers\PermintaanAtkController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::middleware(['auth', 'verified'])->group(function () {
    // Halaman utama user (view_homepage)
    Route::get('/', [HomeController::class, 'index'])
        ->name('home');

    // History user (view_history)
    Route::get('/history', [HomeController::class, 'history'])
        ->name('history');


    // Profile user (bisa semua user terverifikasi)
    Route::get('/profile', [UserController::class, 'show'])
        ->name('user.show');


    // Pengajuan Ruang Rapat (create_booking)
    Route::get('/ruang-rapat', [PemesananRuangRapatController::class, 'create'])
        ->name('ruangrapat.create');

    Route::get('/pemesanan-ruang-rapat-available/', [PemesananRuangRapatController::class, 'getAvailableRooms'])
        ->name('ruangrapat.available');

    Route::post('/ruang-rapat/store', [PemesananRuangRapatController::class, 'store'])
        ->name('ruangrapat.store');

    // Laporan Kerusakan Gedung (create_damage)
    Route::get('/lapor-kerusakan-gedung', [KerusakanGedungController::class, 'create'])
        ->name('kerusakangedung.create');

    Route::post('/kerusakan-gedung/store', [KerusakanGedungController::class, 'store'])
        ->name('kerusakangedung.store');

    // Permintaan ATK (create_supplies)
    Route::get('/permintaan-atk', [PermintaanAtkController::class, 'create'])
        ->name('permintaanatk.create');

    Route::post('/permintaan-atk/store', [PermintaanAtkController::class, 'store'])
        ->name('permintaanatk.store');
});

require __DIR__ . '/settings.php';
