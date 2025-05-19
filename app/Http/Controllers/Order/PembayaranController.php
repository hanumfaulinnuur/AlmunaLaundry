<?php

namespace App\Http\Controllers\Order;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function detailTransaksiOrder($id)
    {
        $transaksi = Transaksi::with('Service')->findOrFail($id);

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $userName = Auth::user()->name ?? 'Guest';

        $params = [
            'transaction_details' => [
                'order_id' => $transaksi->id . '-' . uniqid(),
                'gross_amount' => $transaksi->total_harga,
            ],
            'customer_details' => [
                'name' => $userName,
                'email' => auth()->user()->email,
            ],
        ];

        // Get Snap Token
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('order.detail_transaksi', compact('transaksi', 'snapToken'));
    }

    public function snapTransaksi(Request $request, $id)
    {
        $transaksi = Transaksi::with('Service')->findOrFail($id);

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $userName = Auth::user()->name ?? 'Guest';

        $params = [
            'transaction_details' => [
                'order_id' => $transaksi->id . '-' . uniqid(),
                'gross_amount' => $transaksi->total_harga,
            ],
            'customer_details' => [
                'name' => $userName,
            ],
        ];

        // Get Snap Token
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Simpan data pembayaran awal dengan status pending
        DB::table('pembayarans')->insert([
            'id_transaksi' => $transaksi->id,
            'jenis_pembayaran' => 'midtrans',
            'status_pembayaran' => 'pending',
            'tanggal_pembayaran' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view('order.detail_transaksi', compact('snapToken', 'transaksi'));
    }

    /**
     * Webhook Midtrans Notification Handler
     */
    public function midtransNotification(Request $request)
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $notification = new \Midtrans\Notification();

        $orderId = $notification->order_id; // e.g. "123-abcde"
        $transactionStatus = $notification->transaction_status;

        // Ambil id transaksi asli sebelum tanda "-"
        $transaksiId = explode('-', $orderId)[0];

        // Pastikan insert pembayaran dilakukan sebelum status transaksi diubah
        if (in_array($transactionStatus, ['capture', 'settlement'])) {
            // Insert data pembayaran baru dengan status berhasil
            DB::table('pembayarans')->insert([
                'id_transaksi' => $transaksiId,
                'jenis_pembayaran' => 'midtrans',
                'status_pembayaran' => 'berhasil',
                'tanggal_pembayaran' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Update transaksi jadi selesai
            Transaksi::where('id', $transaksiId)->update([
                'status_transaksi' => 'selesai',
            ]);

            // Setelah transaksi berhasil, arahkan ke halaman invoice
            return redirect()
                ->route('invoice', ['id' => $transaksiId])
                ->with('success', 'Pembayaran berhasil, cek invoice Anda.');
        } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
            // Insert data pembayaran dengan status gagal
            DB::table('pembayarans')->insert([
                'id_transaksi' => $transaksiId,
                'jenis_pembayaran' => 'midtrans',
                'status_pembayaran' => 'gagal',
                'tanggal_pembayaran' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['message' => 'Notification received']);
    }

    // METODE PEMBAYARAN SALDO
    public function bayarDenganSaldo($id)
    {
        $transaksi = Transaksi::with('Service')->findOrFail($id);
        $user = Auth::user();

        // Ambil pelanggan terkait user
        $pelanggan = $user->Pelanggan;

        if (!$pelanggan) {
            return back()->with('error', 'Data pelanggan tidak ditemukan.');
        }

        // Cek apakah saldo cukup
        if ($pelanggan->deposit_saldo < $transaksi->total_harga) {
            return back()->with('error', 'Saldo tidak mencukupi untuk melakukan pembayaran.');
        }

        // Kurangi saldo
        $pelanggan->deposit_saldo -= $transaksi->total_harga;
        $pelanggan->save();

        // Catat ke saldo histori
        DB::table('saldo_historis')->insert([
            'id_pelanggan' => $pelanggan->id,
            'nominal' => $transaksi->total_harga,
            'tanggal_transaksi' => now()->toDateString(),
            'jenis_transaksi' => 'debit',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Catat histori pembayaran di tabel `pembayarans`
        DB::table('pembayarans')->insert([
            'id_transaksi' => $transaksi->id,
            'jenis_pembayaran' => 'saldo',
            'status_pembayaran' => 'berhasil',
            'tanggal_pembayaran' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Update status transaksi
        $transaksi->update(['status_transaksi' => 'selesai']);

        return redirect()
            ->route('invoice', ['id' => $transaksi->id])
            ->with('success', 'Pembayaran melalui saldo berhasil.');
    }

    // METODE PEMBAYARAN CASH
    public function bayarDenganCash($id)
    {
        $transaksi = Transaksi::with('Service')->findOrFail($id);

        // Insert pembayaran dengan status menunggu
        DB::table('pembayarans')->insert([
            'id_transaksi' => $transaksi->id,
            'jenis_pembayaran' => 'cash',
            'status_pembayaran' => 'pending',
            'tanggal_pembayaran' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('riwayat.order')->with('success', 'Pembayaran cash telah diajukan dan menunggu validasi admin.');
    }

    // ADMIN VALIDASI PEMBAYARAN CASH
    public function validasiCash($id)
    {
        DB::table('pembayarans')
            ->where('id_transaksi', $id)
            ->where('jenis_pembayaran', 'cash')
            ->update([
                'status_pembayaran' => 'berhasil',
                'updated_at' => now(),
            ]);

        Transaksi::where('id', $id)->update([
            'status_transaksi' => 'selesai',
        ]);

        return back()->with('success', 'Pembayaran cash berhasil divalidasi.');
    }

    // halaman invoice
    public function invoice($id)
    {
        $transaksi = Transaksi::with('Service')->findOrFail($id);

        // Ambil pembayaran terbaru berdasarkan transaksi
        $pembayaran = DB::table('pembayarans')->where('id_transaksi', $id)->orderBy('tanggal_pembayaran', 'desc')->first();

        return view('order.invoice', compact('transaksi', 'pembayaran'));
    }
}
