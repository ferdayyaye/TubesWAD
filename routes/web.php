<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PembatalanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

// ====================
// Public Routes
// ====================
Route::redirect('/', '/home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ====================
// Auth Routes
// ====================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ====================
// Protected Routes
// ====================
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/deactivate', [ProfileController::class, 'deactivate'])->name('profile.deactivate');

    // Ruang
    Route::get('/ruang/search', [RuangController::class, 'search'])->name('ruang.search');
    Route::get('/ruang/{id}/check', [RuangController::class, 'check'])->name('ruang.check');
    Route::match(['get', 'post'], '/ruang/{id}/pesan', [RuangController::class, 'pesan'])->name('ruang.pesan');

    // Jadwal
    Route::resource('jadwal', JadwalController::class);
    Route::get('/jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');

    // Pemesanan
    Route::resource('pemesanan', PemesananController::class)->only(['index', 'create', 'store']);

    // Riwayat
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');

    // Pembatalan
    Route::get('/pembatalan', [PembatalanController::class, 'index'])->name('pembatalan.index');
    Route::delete('/pembatalan/{id}', [PembatalanController::class, 'destroy'])->name('pembatalan.destroy');

    // Book
    Route::get('/book', [App\Http\Controllers\BookController::class, 'index'])->name('book.index');

    // Admin Section
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('jadwal', JadwalController::class);
        Route::get('/jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
    });
});