<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// ini (/) di blade tuh namanya defult route

Route::get('/', [App\Http\Controllers\LoginController::class, 'login']);
Route::get('login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('actionLogin', [App\Http\Controllers\LoginController::class, 'actionLogin'])->name('actionLogin');
Route::get('logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
    Route::resource('level', App\Http\Controllers\LevelController::class);
    Route::resource('service', App\Http\Controllers\ServiceController::class);
    Route::resource('customer', App\Http\Controllers\CustomerController::class);
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::resource('trans', App\Http\Controllers\TransOrderController::class);
    Route::get('print_invoice/{id}', [App\Http\Controllers\TransOrderController::class, 'printInvoice'])->name('print_invoice');

    Route::post('trans/(id)/snap', [App\Http\Controllers\TransOrderController::class, 'snap'])->name('trans.snap');
});

// get: hanya bisa melihat dan membaca
// post: tambah dan ubah data (form)
// put: ubah data (form)
// delete: hapus data (form)

Route::get('belajar', [App\Http\Controllers\BelajarController::class, 'index']);
Route::get('tambah', [App\Http\Controllers\BelajarController::class, 'tambah'])->name('tambah');
Route::get('edit', [App\Http\Controllers\BelajarController::class, 'nuall']);
Route::post('tambah-action', [App\Http\Controllers\BelajarController::class, 'tambahAction'])->name('tambah-action');
