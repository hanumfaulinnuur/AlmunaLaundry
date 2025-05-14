<?php

namespace App\Http\Controllers\Order;

use Carbon\Carbon;
use App\Models\Service;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function listLaynaan()
    {
        $listLayanan = Service::all();
        return view('order.list_layanan', compact('listLayanan'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_service' => 'required|exists:services,id',
        ]);

        // Ambil user yang sedang login
        $user = auth()->user();

        // Ambil data pelanggan berdasarkan user login
        $pelanggan = Pelanggan::where('id_user', $user->id)->first();

        // Kalau data pelanggan tidak ditemukan
        if (!$pelanggan) {
            return redirect()->back()->with('error', 'Data pelanggan tidak ditemukan!');
        }

        // Ambil data layanan
        $service = Service::findOrFail($request->id_service);

        $transaksi = new Transaksi();
        $transaksi->id_pelanggan = $pelanggan->id;
        $transaksi->id_service = $service->id;
        $transaksi->no_invoice = 'INV-' . strtoupper(Str::random(10));
        $transaksi->tanggal_order = Carbon::now();
        $transaksi->total_berat = null;
        $transaksi->total_harga = null;
        $transaksi->status_transaksi = 'proses validasi';
        $transaksi->save();

        return redirect()->route('list-service')->with('success', 'Order berhasil dibuat!');
    }

    // Admin

    public function listOrderValidasi()
    {
        $listOrderValidasi = Transaksi::with(['Pelanggan.user', 'Service'])
            ->where('status_transaksi', 'proses validasi')
            ->get();

        return view('admin.order_validasi.list_order_masuk', compact('listOrderValidasi'));
    }

    public function validasiOrder(string $id)
    {
        $validasi = Transaksi::findOrFail($id);
        return view('admin.order_validasi.form_validasi', compact('validasi'));
    }

    public function update(Request $request, string $id)
    {
        // Validasi input
        $validated = $request->validate([
            'total_berat' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);

        // Cari transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Update data transaksi dengan data yang tervalidasi
        $transaksi->update($validated);

        // Perbarui status transaksi menjadi 'sedang di proses'
        $transaksi->status_transaksi = 'sedang di proses';

        // Simpan perubahan status
        $transaksi->save();

        // Kembali ke daftar order
        return redirect()->route('order-list-validasi');
    }

    public function listOrderDiproses()
    {
        $listOrderProses = Transaksi::with(['Pelanggan.user', 'Service'])
            ->where('status_transaksi', 'sedang di proses')
            ->get();

        return view('admin.order_validasi.list_order_diproses', compact('listOrderProses'));
    }

    public function konfirmasiProsesSelesai($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_transaksi = 'menunggu pembayaran';
        $transaksi->save();

        return redirect()->route('order-list-diproses');
    }

    public function listOrderMenungguPembayaran() {
        $listOrderPembayaran = Transaksi::with(['Pelanggan.user', 'Service'])
            ->where('status_transaksi', 'menunggu pembayaran')
            ->get();

        return view('admin.order_validasi.list_order_menunggu_pembayaran', compact('listOrderPembayaran'));
    }
}
