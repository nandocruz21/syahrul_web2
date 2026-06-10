<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// Sesuaikan nama controller ini dengan milikmu
use App\Http\Controllers\ProdukController; 

// Route Login (Bebas akses, belum butuh token)
Route::post('/login', [AuthController::class, 'login']);

// Akses data wajib melalui proses autentikasi (harus bawa token)
Route::middleware('auth:sanctum')->group(function () {
    
    // Fitur Tambah, Tampil, dan Ubah bisa diakses oleh admin & user biasa
    Route::get('/produk', [ProdukController::class, 'index']);
    Route::get('/produk/{id}', [ProdukController::class, 'show']);
    Route::post('/produk', [ProdukController::class, 'store']);
    Route::put('/produk/{id}', [ProdukController::class, 'update']);
    
    // Fitur Hapus HANYA bisa dilakukan oleh admin
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])
         ->middleware('role:admin');
         
});