<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

// Redirect awal ke login
Route::get('/', function () {
    return view('landing');
});

// Rute Auth (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'proses'])->name('login.proses');
});

// Rute Internal (Harus Login)
Route::middleware('auth')->group(function () {
    
    // Profil (Semua Role bisa akses, tapi hanya melihat)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Tambahkan ini
    
    // Dashboard (Akan diatur di Controller berdasarkan Role)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::put('/notifications/mark-read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.mark-read');

    // ================= RUTE ADMIN =================
    Route::middleware('role:admin')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('inventories', InventoryController::class);
        Route::resource('admin/users', UserController::class)->names([
            'index' => 'users.index',
            'store' => 'users.store',
            'update' => 'users.update',
            'destroy' => 'users.destroy',
        ]);
        
        Route::get('/admin/peminjaman', [LoanController::class, 'indexAdmin'])->name('admin.loans.index');
        Route::put('/admin/peminjaman/{loan}/verifikasi', [LoanController::class, 'verifikasi'])->name('admin.loans.verifikasi');
        Route::put('/admin/peminjaman/{loan}/serah-terima', [LoanController::class, 'serahTerima'])->name('admin.loans.serah');
        Route::get('/admin/peminjaman/{loan}/kembali', [LoanController::class, 'formPengembalian'])->name('admin.loans.form-kembali');
        Route::put('/admin/peminjaman/{loan}/kembali', [LoanController::class, 'prosesPengembalian'])->name('admin.loans.proses-kembali');

        Route::get('/admin/laporan', [ReportController::class, 'index'])->name('admin.reports.index');
        // Rute QR Code
        Route::get('/admin/inventaris/{inventory}/qr', [InventoryController::class, 'printQr'])->name('inventories.qr');
        Route::get('/admin/laporan/pdf', [ReportController::class, 'exportPdf'])->name('admin.reports.pdf');
        Route::get('/admin/laporan/excel', [ReportController::class, 'exportExcel'])->name('admin.reports.excel');
        Route::get('/admin/log-aktivitas', [App\Http\Controllers\DashboardController::class, 'logs'])->name('admin.logs');
        // Rute Denda
        Route::get('/admin/denda', [LoanController::class, 'daftarDenda'])->name('admin.fines.index');
        Route::put('/admin/denda/{loan}/bayar', [LoanController::class, 'bayarDenda'])->name('admin.fines.bayar');
    });

        // ================= RUTE SISWA & GURU (Peminjaman) =================
    Route::middleware('role:siswa,guru')->group(function () {
        Route::get('/katalog', [LoanController::class, 'katalog'])->name('siswa.katalog');
        Route::get('/katalog/pinjam/{inventory}', [LoanController::class, 'formPinjam'])->name('siswa.pinjam');
        Route::post('/katalog/pinjam/{inventory}', [LoanController::class, 'simpanPinjam'])->name('siswa.simpan');
        Route::get('/peminjaman-saya', [LoanController::class, 'riwayatSiswa'])->name('siswa.peminjaman');
        // Fitur Keranjang (Cart)
        Route::get('/katalog/keranjang', [LoanController::class, 'viewCart'])->name('siswa.cart');
        Route::post('/katalog/keranjang/tambah/{inventory}', [LoanController::class, 'addToCart'])->name('siswa.cart.add');
        Route::delete('/katalog/keranjang/hapus/{id}', [LoanController::class, 'removeFromCart'])->name('siswa.cart.remove');
        Route::post('/katalog/keranjang/checkout', [LoanController::class, 'checkoutCart'])->name('siswa.cart.checkout');
        Route::get('/katalog/detail/{inventory}', [LoanController::class, 'showDetail'])->name('siswa.detail');
    });

    // Rute Khusus Guru (Monitoring jika masih diperlukan)
    Route::middleware('role:guru')->group(function () {
        Route::get('/guru/inventaris', [InventoryController::class, 'index'])->name('guru.inventories.index');
        Route::get('/guru/peminjaman', [LoanController::class, 'indexGuru'])->name('guru.loans.index');
    });

    Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
});