<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\StockBarangController;
use App\Http\Controllers\Web\StokBarangController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PengembalianController; // Import
use App\Http\Controllers\StockController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LaporanController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard route
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Kategori
    Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::delete('kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::put('kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');

    //klik
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

    // Barang
    Route::get('barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::delete('barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::put('barang/{barang}', [BarangController::class, 'update'])->name('barang.update');

    // Pengembalian
    // Route::prefix('pengembalian')->name('pengembalian.')->group(function () {
    //     Route::get('/', [PengembalianController::class, 'index'])->name('index');
    //     Route::get('/{pengembalian}', [PengembalianController::class, 'show'])->name('show');
    // });

    //stock
    Route::get('/', [StockBarangController::class, 'index'])->name('stock.index');
    Route::get('/create', [StockBarangController::class, 'create'])->name('stock.create');
    Route::post('/store', [StockBarangController::class, 'store'])->name('stock.store');
    Route::get('/edit/{id}', [StockBarangController::class, 'edit'])->name('stock.edit');
    Route::put('/update/{id}', [StockBarangController::class, 'update'])->name('stock.update');
    Route::delete('/destroy/{id}', [StockBarangController::class, 'destroy'])->name('stock.destroy');


    // Peminjaman
    Route::get('/admin/peminjaman', [PeminjamanController::class, 'index'])->name('admin.peminjaman.index');
    Route::get('/admin/peminjaman/create', [PeminjamanController::class, 'create'])->name('admin.peminjaman.create');
    Route::post('/admin/peminjaman', [PeminjamanController::class, 'store'])->name('admin.peminjaman.store');
    Route::get('/admin/peminjaman/{peminjaman}/edit', [PeminjamanController::class, 'edit'])->name('admin.peminjaman.edit');
    Route::put('/admin/peminjaman/{peminjaman}', [PeminjamanController::class, 'update'])->name('admin.peminjaman.update');
    Route::delete('/admin/peminjaman/{peminjaman}', [PeminjamanController::class, 'destroy'])->name('admin.peminjaman.destroy');
    Route::post('/admin/peminjaman/{peminjaman}/approve', [PeminjamanController::class, 'approve'])->name('admin.peminjaman.approve');
    Route::post('/admin/peminjaman/{peminjaman}/reject', [PeminjamanController::class, 'reject'])->name('admin.peminjaman.reject');
    Route::post('/admin/peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'kembali'])->name('admin.peminjaman.kembali');
    Route::get('/admin/peminjaman/{peminjaman}', [PeminjamanController::class, 'show'])->name('admin.peminjaman.show');

    // Pengembalian
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('/pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
    Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
    Route::get('/pengembalian/{id}', [PengembalianController::class, 'show'])->name('pengembalian.show');
    Route::post('/pengembalian/{id}/approve', [PengembalianController::class, 'approve'])->name('pengembalian.approve');
    Route::post('/pengembalian/{id}/reject', [PengembalianController::class, 'reject'])->name('pengembalian.reject');

    Route::prefix('peminjaman')->name('admin.peminjaman.')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index'])->name('index');
        Route::get('/{peminjaman}', [PeminjamanController::class, 'show'])->name('show');
        Route::post('/{peminjaman}/approve', [PeminjamanController::class, 'approve'])->name('approve');
        Route::post('/{peminjaman}/reject', [PeminjamanController::class, 'reject'])->name('reject');
    });

    Route::prefix('user')->name('admin.user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/peminjaman', [LaporanController::class, 'peminjaman'])->name('peminjaman');
        Route::get('/pengembalian', [LaporanController::class, 'pengembalian'])->name('pengembalian');
    });
});

Route::prefix('stock')->name('stock.')->group(function () {
    Route::get('/', [StockbarangController::class, 'index'])->name('index');
});


Route::get('/user', function () {
    return ('user');
})->middleware('auth', 'role:user');











