<?php

namespace App\Http\Controllers\Saldo;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Pelanggan;
use App\Models\SaldoHistori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config as LaravelConfig;

class SaldoController extends Controller
{
    public function RiwayatTransaksi()
    {
        $user = Auth::user();
        $pelanggan = Pelanggan::where('id_user', $user->id)->first();

        if (!$pelanggan) {
            $riwayat = collect();
            $saldo = 0;
        } else {
            $riwayat = SaldoHistori::where('id_pelanggan', $pelanggan->id)->orderBy('created_at', 'desc')->get();
            $saldo = $pelanggan->deposit_saldo ?? 0;
        }

        return view('saldo.view', compact('riwayat', 'saldo'));
    }

    public function isiSaldo()
    {
        $user = Auth::user();
        $pelanggan = Pelanggan::where('id_user', $user->id)->first();

        $saldo = $pelanggan ? $pelanggan->deposit_saldo : 0;

        return view('saldo.isi_saldo', compact('saldo'));
    }

    public function __construct()
    {
        Config::$isProduction = LaravelConfig::get('midtrans.is_production', false);
        Config::$serverKey = LaravelConfig::get('midtrans.server_key');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function charge(Request $request)
    {
        $amount = (int) $request->input('amount');

        if ($amount <= 0) {
            return response()->json(['error' => 'Nominal isi saldo tidak valid'], 400);
        }

        $params = [
            'transaction_details' => [
                'order_id' => 'TOPUP-' . uniqid(),
                'gross_amount' => $amount,
            ],
            'customer_details' => [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            \Log::error('Midtrans error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

public function updateSaldo(Request $request)
{
    // Ambil user yang sedang login
    $user = Auth::user();

    // Cari data pelanggan berdasarkan user id
    $pelanggan = Pelanggan::where('id_user', $user->id)->first();

    if (!$pelanggan) {
        return response()->json(['error' => 'Data pelanggan tidak ditemukan'], 404);
    }

    // Validasi input amount, harus angka positif bulat
    $amount = $request->input('amount');
    if (!is_numeric($amount) || (int) $amount <= 0) {
        return response()->json(['error' => 'Nominal tidak valid'], 400);
    }
    $amount = (int) $amount;

    DB::beginTransaction();

    try {
        // Tambah saldo deposit pelanggan
        $pelanggan->deposit_saldo += $amount;
        $pelanggan->save();

        // Catat riwayat transaksi saldo (kredit)
        SaldoHistori::create([
            'id_pelanggan' => $pelanggan->id,
            'nominal' => $amount,
            'tanggal_transaksi' => now(),
            'jenis_transaksi' => 'kredit',
        ]);

        DB::commit();

        return response()->json(['success' => 'Saldo berhasil diupdate']);
    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Update saldo error: ' . $e->getMessage());
        return response()->json(['error' => 'Gagal update saldo'], 500);
    }
}

}
