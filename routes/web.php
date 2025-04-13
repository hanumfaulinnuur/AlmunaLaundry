<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Saldo\SaldoController;
use App\Http\Controllers\admin\BerandaController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\pelanggan\PelangganController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Global Controller
Route::get('/tentang-kami', [GlobalController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/lacak-status', [GlobalController::class, 'lacakStatus'])->name('lacak-status');

//Order Controller
Route::get('/list-service', [OrderController::class, 'listLaynaan'])->name('list-service');

//Saldo Controller
Route::middleware('auth')->group(function () {
    Route::get('/saldo', [SaldoController::class, 'lihatSaldo'])->name('saldo');
});


// Beranda Admin Controller
Route::group(['prefix' => 'admin'], function () {
    Route::get('/beranda', [BerandaController::class, 'index']);
});

// Service Controller
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('services', ServiceController::class);
    });

// Pelanggan Controller
Route::prefix('pelanggan')->group(function () {
    Route::get('/list-pelanggan', [PelangganController::class, 'index'])->name('list.pelanggan');
    Route::get('/tambah-pelanggan', [PelangganController::class, 'create'])->name('tambah.pelanggan');
    Route::post('/proses-tambah-pelanggan', [PelangganController::class, 'store'])->name('proses.tambah.pelanggan');
});



require __DIR__ . '/auth.php';
