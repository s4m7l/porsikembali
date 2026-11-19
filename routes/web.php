<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodPackageController;
use App\Http\Controllers\StudentFoodPackageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PartnerReservationController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminPartnerController;
use App\Http\Controllers\AdminReportController;

// Halaman utama diarahkan ke halaman login
Route::get('/', function () {
    return redirect('/login');
});

// Menampilkan halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');

// Memproses data login
Route::post('/login', [AuthController::class, 'login']);

// Memproses logout, hanya untuk pengguna yang sudah login
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth');

// Dashboard berdasarkan role pengguna
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Pengelolaan paket makanan oleh mitra kantin
Route::middleware('auth')
    ->prefix('partner')
    ->name('partner.')
    ->group(function () {

        // Menampilkan daftar paket makanan
        Route::get('/food-packages', [FoodPackageController::class, 'index'])
            ->name('food-packages.index');

        // Menampilkan formulir tambah paket
        Route::get('/food-packages/create', [FoodPackageController::class, 'create'])
            ->name('food-packages.create');

        // Menyimpan paket makanan baru
        Route::post('/food-packages', [FoodPackageController::class, 'store'])
            ->name('food-packages.store');

        // Menampilkan formulir edit paket
        Route::get('/food-packages/{id}/edit', [FoodPackageController::class, 'edit'])
            ->name('food-packages.edit');

        // Memperbarui paket makanan
        Route::put('/food-packages/{id}', [FoodPackageController::class, 'update'])
            ->name('food-packages.update');

        // Menghapus paket makanan
        Route::delete('/food-packages/{id}', [FoodPackageController::class, 'destroy'])
            ->name('food-packages.destroy');

        // Menampilkan reservasi yang masuk ke kantin mitra
        Route::get(
            '/reservations',
            [PartnerReservationController::class, 'index']
        )->name('reservations.index');

        // Mengubah status reservasi menjadi selesai
        Route::patch(
            '/reservations/{id}/complete',
            [PartnerReservationController::class, 'updateStatus']
        )->name('reservations.complete');
    });

// Katalog dan reservasi paket makanan untuk mahasiswa
Route::middleware('auth')
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        // Menampilkan katalog paket makanan
        Route::get(
            '/food-packages',
            [StudentFoodPackageController::class, 'index']
        )->name('food-packages.index');

        // Memproses reservasi paket makanan
        Route::post(
            '/reservations',
            [ReservationController::class, 'store']
        )->name('reservations.store');

        // Menampilkan riwayat reservasi mahasiswa
        Route::get(
            '/reservations',
            [ReservationController::class, 'index']
        )->name('reservations.index');
    });

// Pengelolaan pengguna oleh admin
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Menampilkan daftar pengguna
        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');

        // Menampilkan formulir edit pengguna
        Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])
            ->name('users.edit');

        // Memperbarui data pengguna
        Route::put('/users/{id}', [AdminUserController::class, 'update'])
            ->name('users.update');

        // Menampilkan daftar mitra kantin
        Route::get('/partners', [AdminPartnerController::class, 'index'])
            ->name('partners.index');

        // Menampilkan formulir edit mitra
        Route::get('/partners/{id}/edit', [AdminPartnerController::class, 'edit'])
            ->name('partners.edit');

        // Memperbarui data mitra kantin
        Route::put('/partners/{id}', [AdminPartnerController::class, 'update'])
            ->name('partners.update');

        // Menampilkan laporan aktivitas aplikasi
        Route::get('/reports', [AdminReportController::class, 'index'])
            ->name('reports.index');
    });