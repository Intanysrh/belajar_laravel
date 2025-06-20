<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// get: hanya bisa melihat dan membaca
// post: tambah dan ubah data (form)
// put: ubah data (form)
// delete: hapus data (form)

Route::get('belajar', [App\Http\Controllers\BelajarController::class, 'index']);
Route::get('tambah', [App\Http\Controllers\BelajarController::class, 'tambah'])->name('tambah');
Route::get('edit', [App\Http\Controllers\BelajarController::class, 'nuall']);
Route::post('tambah-action', [App\Http\Controllers\BelajarController::class, 'tambahAction'])->name('tambah-action');
