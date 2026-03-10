<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing/index');
})->name('landing');

Route::get('/landing', function () {
    return view('landing/index');
});

Route::get('/produks', [App\Http\Controllers\ProdukController::class, 'index'])->name('produks.index');

Route::get('/cv', [App\Http\Controllers\CvController::class, 'index'])->name('cv.index');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');

// Admin CRUD Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('pengeluaran', App\Http\Controllers\PengeluaranController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);

    Route::resource('laporan-harian', App\Http\Controllers\LaporanHarianController::class)
        ->only(['index', 'store', 'update', 'destroy']);
});
