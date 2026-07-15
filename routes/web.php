<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes - Cravely Coffee Shop
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return redirect()->route('login');
});


// Login
Route::middleware(['guest:barista'])->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');

});


// Setelah login (semua barista, apapun posisinya)
Route::middleware(['auth:barista'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Transaksi — boleh diakses semua barista yang login
    Route::resource('pesanan', PesananController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('reservasi', ReservasiController::class);

    // Profile barista yang sedang login
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    // Master Data — KHUSUS ADMIN, dilindungi middleware 'admin'
    Route::middleware(['admin'])->group(function () {

        Route::resource('kategori', KategoriController::class);
        Route::resource('menu', MenuController::class);

    });

});