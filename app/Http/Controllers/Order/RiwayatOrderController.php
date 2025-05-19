<?php

namespace App\Http\Controllers\Order;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RiwayatOrderController extends Controller
{
    public function Riwayat()
    {
        $pelanggan = Auth::user()->Pelanggan;
        $transaksis = $pelanggan ? $pelanggan->Transaksi()->orderByDesc('created_at')->get() : collect();

        return view('order.riwayat_order', compact('transaksis'));
    }
    public function detailStepper($id)
    {
        $transaksi = Transaksi::with('Service')->findOrFail($id);
        return view('order.partial_stepper', compact('transaksi'));
    }
}
