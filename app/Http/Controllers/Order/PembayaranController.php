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
                'gross_amount' => $transaksi->total_harga + 3000, // Tambah biaya admin Midtrans
            ],
            'customer_details' => [
                'name' => $userName,
                'email' => auth()->user()->email,
            ],
        ];

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

        $params = [
            'transaction_details' => [
                'order_id' => $transaksi->id . '-' . uniqid(),
                'gross_amount' => $transaksi->total_harga + 3000,
            ],
            'customer_details' => [
                'name' => Auth::user()->name,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('order.detail_transaksi', compact('snapToken', 'transaksi'));
    }

    public function midtransNotification(Request $request)
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $notification = new \Midtrans\Notification();
        $orderId = $notification->order_id;
        $status = $notification->transaction_status;
        $grossAmount = $notification->gross_amount;

        $transaksiId = explode('-', $orderId)[0];

        $transaksi = Transaksi::find($transaksiId);
        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $biayaAdmin = max($grossAmount - $transaksi->total_harga, 0);

        if (in_array($status, ['capture', 'settlement'])) {
            $existing = DB::table('pembayarans')
                ->where('id_transaksi', $transaksiId)
                ->where('jenis_pembayaran', 'midtrans')
                ->first();

            if (!$existing) {
                DB::table('pembayarans')->insert([
                    'id_transaksi' => $transaksiId,
                    'jenis_pembayaran' => 'midtrans',
                    'status_pembayaran' => 'berhasil',
                    'biaya_admin' => $biayaAdmin,
                    'tanggal_pembayaran' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('pembayarans')->where('id', $existing->id)->update([
                    'status_pembayaran' => 'berhasil',
                    'biaya_admin' => $biayaAdmin,
                    'updated_at' => now(),
                ]);
            }

            Transaksi::where('id', $transaksiId)->update([
                'status_transaksi' => 'selesai',
            ]);
        } elseif (in_array($status, ['deny', 'cancel', 'expire'])) {
            DB::table('pembayarans')
                ->where('id_transaksi', $transaksiId)
                ->where('jenis_pembayaran', 'midtrans')
                ->update([
                    'status_pembayaran' => 'gagal',
                    'updated_at' => now(),
                ]);
        }

        return response()->json(['message' => 'Notification processed']);
    }

    public function bayarDenganSaldo($id)
    {
        $transaksi = Transaksi::with('Service')->findOrFail($id);
        $user = Auth::user();
        $pelanggan = $user->Pelanggan;

         if ($pelanggan->deposit_saldo < $transaksi->total_harga) {
        return back()->with('saldo_kurang', true);
    }

        $pelanggan->deposit_saldo -= $transaksi->total_harga;
        $pelanggan->save();

        DB::table('saldo_historis')->insert([
            'id_pelanggan' => $pelanggan->id,
            'nominal' => $transaksi->total_harga,
            'tanggal_transaksi' => now(),
            'jenis_transaksi' => 'debit',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('pembayarans')->insert([
            'id_transaksi' => $transaksi->id,
            'jenis_pembayaran' => 'saldo',
            'status_pembayaran' => 'berhasil',
            'biaya_admin' => 0,
            'tanggal_pembayaran' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $transaksi->update(['status_transaksi' => 'selesai']);

        return redirect()->route('invoice', $transaksi->id)->with('success', 'Pembayaran saldo berhasil.');
    }

    public function bayarDenganCash($id)
    {
        $transaksi = Transaksi::with('Service')->findOrFail($id);

        DB::table('pembayarans')->insert([
            'id_transaksi' => $transaksi->id,
            'jenis_pembayaran' => 'cash',
            'status_pembayaran' => 'pending',
            'biaya_admin' => 0,
            'tanggal_pembayaran' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('riwayat.order')->with('success', 'Pembayaran cash diajukan, menunggu validasi.');
    }

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

        return back()->with('success', 'Pembayaran cash divalidasi.');
    }

    public function invoice($id)
    {
        $transaksi = Transaksi::with('Service')->findOrFail($id);
        $pembayaran = DB::table('pembayarans')->where('id_transaksi', $id)->latest('tanggal_pembayaran')->first();

        return view('order.invoice', compact('transaksi', 'pembayaran'));
    }
}