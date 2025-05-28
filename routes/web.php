<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Saldo\SaldoController;
use App\Http\Controllers\admin\BerandaController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\Ekspor\EksporController;
use App\Http\Controllers\admin\RekapOrderController;
use App\Http\Controllers\Order\PembayaranController;
use App\Http\Controllers\Order\RiwayatOrderController;
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
    Route::get('/form-profile', [ProfileController::class, 'formEdit'])->name('profile.form.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Global Controller
Route::get('/tentang-kami', [GlobalController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/lacak-status', [GlobalController::class, 'lacakStatus'])->name('lacak-status');

//Order Controller
Route::get('/list-service', [OrderController::class, 'listLaynaan'])->name('list-service');
Route::post('/order/store', [OrderController::class, 'store'])
    ->name('order.store')
    ->middleware('auth');

// Route untuk menampilkan riwayat
Route::get('riwayat', [RiwayatOrderController::class, 'Riwayat'])->name('riwayat.order');

// Route detail transaksi
Route::get('/riwayat-order/detail/{id}', [RiwayatOrderController::class, 'detailStepper']);
Route::get('detail-transaksi-order/{id}', [PembayaranController::class, 'detailTransaksiOrder'])->name('detail.transaksi.order');

//Route untuk menampilkan halaman detail + token pembayaran
Route::get('/bayar-transaksi/{id}', [PembayaranController::class, 'snapTransaksi'])->name('bayar.transaksi');
Route::post('/order/pembayaran-saldo/{id}', [PembayaranController::class, 'bayarDenganSaldo'])->name('pembayaran.saldo');

// Untuk pelanggan
Route::post('/pembayaran/cash/{id}', [PembayaranController::class, 'bayarDenganCash'])->name('pembayaran.cash');

// Untuk admin validasi
Route::post('/admin/validasi-cash/{id}', [PembayaranController::class, 'validasiCash'])->name('admin.validasi.cash');


Route::get('/invoice/{id}', [PembayaranController::class, 'invoice'])->name('invoice');

//Order Controller Sub Validasi Pesanan
Route::get('/order-list-validasi', [OrderController::class, 'listOrderValidasi'])->name('order-list-validasi');
Route::get('/order-validasi/{id}', [OrderController::class, 'validasiOrder'])->name('order-validasi');
Route::put('/order-update/{id}', [OrderController::class, 'update'])->name('order.update');

//Order Controller Sub Proses Pesanan
Route::get('/order-list-diproses', [OrderController::class, 'listOrderDiproses'])->name('order-list-diproses');

//Order Controller Konfirmasi Pesanan Selesai Diproses
Route::put('/order-konfirmasi/{id}', [OrderController::class, 'konfirmasiProsesSelesai'])->name('order.proses.konfirmasi');

//Order Controller Sub Menunggu Pembayaran
Route::get('/order-list-pembayaran', [OrderController::class, 'listOrderMenungguPembayaran'])->name('order-list-pembayaran');

// Ekspor Data
Route::get('/invoice/{id}/download', [EksporController::class, 'eksporInvoicePDF'])->name('invoice.download');
Route::get('/export-excel', [EksporController::class, 'exportRekapOrderExcel'])->name('ekspor.excel');


//Rekap Order Selesai
Route::get('/rekap-order', [RekapOrderController::class, 'orderSelesai'])->name('rekap-order-selesai');

//Saldo Controller
Route::middleware('auth')->group(function () {
    Route::get('/saldo', [SaldoController::class, 'RiwayatTransaksi'])->name('saldo');
    Route::get('/isi-saldo', [SaldoController::class, 'isiSaldo'])->name('isi.saldo');
    Route::post('/midtrans/charge', [SaldoController::class, 'charge'])->name('midtrans.charge')->middleware('auth');
    Route::post('/midtrans/update-saldo', [SaldoController::class, 'updateSaldo'])->name('midtrans.updateSaldo')->middleware('auth');
});

// Beranda Admin Controller
Route::group(['prefix' => 'admin'], function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('admin.beranda');
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
