<?php

namespace App\Http\Controllers\Saldo;

use App\Models\SaldoHistori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SaldoController extends Controller
{
    public function RiwayatTransaksi()
{
    $user = Auth::user();
    $riwayat = SaldoHistori::where('id_pelanggan', $user->id)
                ->orderBy('tanggal_transaksi', 'desc')
                ->get();

    return view('saldo.view', compact('riwayat'));
}

    public function isiSaldo() {
        return view('saldo.isi_saldo');
    }
}
