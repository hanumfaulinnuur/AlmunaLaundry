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
    ->middleware(['auth', 'verified', 'role:pelanggan'])
    ->name('dashboard');

Route::get('/tentang-kami', [GlobalController::class, 'tentangKami'])->name('global.tentang.kami');
Route::get('/lacak-status', [GlobalController::class, 'lacakStatus'])->name('global.lacak.status');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/form-profile', [ProfileController::class, 'formEdit'])->name('profile.form');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/list-service', [OrderController::class, 'listLaynaan'])->name('order.list');
Route::post('/order/store', [OrderController::class, 'store'])
    ->name('order.store')
    ->middleware(['auth', 'role:pelanggan']);

Route::middleware('auth', 'role:pelanggan')->group(function () {
    Route::get('riwayat', [RiwayatOrderController::class, 'Riwayat'])->name('riwayat.order');
    Route::get('/riwayat-order/detail/{id}', [RiwayatOrderController::class, 'detailStepper'])->name('riwayat.order.detail');
});

Route::middleware('auth', 'role:pelanggan')->group(function () {
    Route::get('detail-transaksi-order/{id}', [PembayaranController::class, 'detailTransaksiOrder'])->name('detail.transaksi.order');
    Route::get('/bayar-transaksi/{id}', [PembayaranController::class, 'snapTransaksi'])->name('bayar.transaksi');
    Route::post('/order/pembayaran-saldo/{id}', [PembayaranController::class, 'bayarDenganSaldo'])->name('pembayaran.saldo');
    Route::post('/pembayaran/cash/{id}', [PembayaranController::class, 'bayarDenganCash'])->name('pembayaran.cash');
    Route::get('/invoice/{id}', [PembayaranController::class, 'invoice'])->name('invoice');
});

Route::post('/admin/validasi-cash/{id}', [PembayaranController::class, 'validasiCash'])
    ->name('admin.validasi.cash')
    ->middleware('role:admin');

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/order-list-validasi', [OrderController::class, 'listOrderValidasi'])->name('order-list-validasi'); //jelek
    Route::get('/order-validasi/{id}', [OrderController::class, 'validasiOrder'])->name('order.validasi');
    Route::put('/order-update/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::get('/order-list-diproses', [OrderController::class, 'listOrderDiproses'])->name('order-list-diproses'); //jelek
    Route::get('/order-list-pembayaran', [OrderController::class, 'listOrderMenungguPembayaran'])->name('order-list-pembayaran'); //jelek
});

Route::put('/order-konfirmasi/{id}', [OrderController::class, 'konfirmasiProsesSelesai'])->name('order-proses-konfirmasi'); //jelek

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/invoice/{id}/download', [EksporController::class, 'eksporInvoicePDF'])->name('invoice.download');
    Route::get('/export-excel', [EksporController::class, 'exportRekapOrderExcel'])->name('ekspor.excel');
});

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/rekap-order', [RekapOrderController::class, 'orderSelesai'])->name('rekap-order-selesai'); //jelek banget
    Route::get('/rekap-order-detail', [RekapOrderController::class, 'orderDetail'])->name('rekap-order-detail'); //jelek anjay
});

Route::middleware('auth', 'role:pelanggan')->group(function () {
    Route::get('/saldo', [SaldoController::class, 'RiwayatTransaksi'])->name('saldo');
    Route::get('/isi-saldo', [SaldoController::class, 'isiSaldo'])->name('isi.saldo');
    Route::post('/midtrans/charge', [SaldoController::class, 'charge'])->name('midtrans.charge');
    Route::post('/midtrans/update-saldo', [SaldoController::class, 'updateSaldo'])->name('midtrans.updateSaldo');
});

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('admin.beranda');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('services', ServiceController::class);
    });

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/list-pelanggan', [PelangganController::class, 'index'])->name('list.pelanggan');
    Route::get('/tambah-pelanggan', [PelangganController::class, 'create'])->name('tambah.pelanggan');
    Route::post('/proses-tambah-pelanggan', [PelangganController::class, 'store'])->name('proses.tambah.pelanggan');
});

require __DIR__ . '/auth.php';
