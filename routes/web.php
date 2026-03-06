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

// Pengeluaran CRUD
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('pengeluaran', App\Http\Controllers\PengeluaranController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);
});
