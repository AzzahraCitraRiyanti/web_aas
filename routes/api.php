<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BarangApiController;
use App\Http\Controllers\Api\PeminjamanApiController;
use App\Http\Controllers\Api\PengembalianApiController;
use App\Http\Controllers\Api\ProfilleApiController;

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);


    // Profile
    Route::get('/profile', [ProfilleApiController::class, 'show']);
    Route::post('/profile', [ProfilleApiController::class, 'update']);
    Route::post('/profile/photo', [ProfilleApiController::class, 'uploadPhoto']);
    Route::post('/profile/password', [ProfilleApiController::class, 'updatePassword']);
});

// Pengembalian (butuh login)
    Route::post('/pengembalian', [PengembalianApiController::class, 'store']);
    Route::put('/pengembalian/{id}', [PengembalianApiController::class, 'update']);


// Peminjaman (butuh login)
    Route::post('/peminjaman', [PeminjamanApiController::class, 'store']);
    Route::get('/peminjaman', [PeminjamanApiController::class, 'index']);

// Pengembalian (public view)
Route::get('/pengembalian', [PengembalianApiController::class, 'index']);
Route::get('/pengembalian/{id}', [PengembalianApiController::class, 'show']);
Route::get('/pengembalian/user/{userId}', [PengembalianApiController::class, 'riwayat']);

// Barang (boleh public untuk read, butuh auth untuk write)
Route::get('/barang', [BarangApiController::class, 'index']);
Route::get('/barang/{id}', [BarangApiController::class, 'show']);
Route::get('/barang/{id}/stock', [BarangApiController::class, 'checkStock']);

// Barang management (butuh auth)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/barang', [BarangApiController::class, 'store']);
    Route::put('/barang/{id}', [BarangApiController::class, 'update']);
    Route::delete('/barang/{id}', [BarangApiController::class, 'destroy']);
});