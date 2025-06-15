<?php

use Illuminate\Support\Facades\Route;

// DAFTAR IMPORT CONTROLLER
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Wartawan\BeritaController;
use App\Http\Controllers\Editor\ApprovalController;


// RUTE HALAMAN UTAMA
Route::get('/', function () {
    return view('welcome');
});


// RUTE UNTUK SEMUA USER YANG SUDAH LOGIN
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// RUTE KHUSUS UNTUK ADMIN
Route::middleware(['auth', 'level:admin'])->group(function () {
    Route::prefix('admin')->group(function () { 
        Route::resource('kategori', KategoriController::class);
        Route::resource('users', UserController::class)->except(['create', 'store', 'show']);
    });
});


// RUTE KHUSUS UNTUK WARTAWAN (Admin juga bisa akses)
Route::middleware(['auth', 'level:wartawan,admin'])->group(function () {
    Route::prefix('wartawan')->group(function () {
        // --- PERBAIKAN UTAMA ADA DI BARIS INI ---
        // Kita paksa Laravel untuk menggunakan 'berita' sebagai nama parameter
        Route::resource('berita', BeritaController::class)->parameters([
            'berita' => 'berita'
        ]);
    });
});


// RUTE KHUSUS UNTUK EDITOR (Admin juga bisa akses)
Route::middleware(['auth', 'level:editor,admin'])->group(function () {
    Route::prefix('editor')->group(function () {
        Route::get('approval', [ApprovalController::class, 'index'])->name('approval.index');
        Route::get('approval/{berita}', [ApprovalController::class, 'show'])->name('approval.show');
        Route::post('approval/{berita}/approve', [ApprovalController::class, 'approve'])->name('approval.approve');
        Route::post('approval/{berita}/reject', [ApprovalController::class, 'reject'])->name('approval.reject');
        Route::get('published', [ApprovalController::class, 'publishedList'])->name('approval.published');
    });
});


// Rute bawaan Breeze
require __DIR__.'/auth.php';