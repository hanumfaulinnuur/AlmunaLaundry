<?php

namespace App\Http\Controllers\Order;

use Carbon\Carbon;
use App\Models\Service;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\WhatsappHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

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

    // Cek nomor telepon
    if (!$pelanggan->no_telepon || trim($pelanggan->no_telepon) == '') {
        // Kalau no telepon kosong, redirect ke halaman layanan dengan flag modal muncul
        return redirect()->route('list-service')->with('phone_missing', true);
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

    public function listOrderValidasi(Request $request)
{
    $search = $request->input('search');

    $listOrderValidasi = Transaksi::with(['Pelanggan.user', 'Service'])
        ->where('status_transaksi', 'proses validasi')
        ->when($search, function ($query, $search) {
            $query->whereHas('Pelanggan.user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        })
        ->paginate(10)
        ->withQueryString();

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

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($validated);
        $transaksi->status_transaksi = 'sedang di proses';
        $transaksi->save();

        return redirect()->route('order-list-validasi')->with('success', 'Order Berhasil Di validasi');
    }

    public function listOrderDiproses(Request $request)
    {
        $search = $request->input('search');
        $listOrderProses = Transaksi::with(['Pelanggan.user', 'Service'])
            ->where('status_transaksi', 'sedang di proses')
            ->when($search, function ($query, $search) {
                $query->whereHas('Pelanggan.user', function ($q) use ($search){
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.order_validasi.list_order_diproses', compact('listOrderProses'));
    }

    public function konfirmasiProsesSelesai($id)
    {
        $transaksi = Transaksi::with('Pelanggan')->findOrFail($id);
        $transaksi->status_transaksi = 'menunggu pembayaran';
        $transaksi->tanggal_selesai = now();
        $transaksi->save();

        $noHp = $transaksi->Pelanggan->no_telepon;
        $nama = $transaksi->Pelanggan->user->name ?? 'Pelanggan';
        $invoice = $transaksi->no_invoice;
        $service = $transaksi->service->nama_service;
        $total_berat = $transaksi->total_berat;
        $total_harga = $transaksi->total_harga ? number_format($transaksi->total_harga, 0, ',', '.') : '-';
        $pesan = View::make('order.notifikasi_wa', compact('nama', 'invoice', 'service', 'total_berat', 'total_harga'))->render();

        WhatsappHelper::send($noHp, $pesan);

        return redirect()->route('order-list-diproses')->with('success', 'Konfirmasi Order Selesai Berhasil');
    }

    public function listOrderMenungguPembayaran(Request $request)
    {
        $search = $request->input('search');
        $listOrderPembayaran = Transaksi::with(['Pelanggan.user', 'Service'])
            ->where('status_transaksi', 'menunggu pembayaran')
            ->when($search, function ($query, $search) {
                $query->whereHas('Pelanggan.user', function ($q) use ($search){
                    $q->where('name', 'like', "%{$search}%");
                });
                })
            ->paginate(10)
            ->withQueryString();

        return view('admin.order_validasi.list_order_menunggu_pembayaran', compact('listOrderPembayaran'));
    }
}
