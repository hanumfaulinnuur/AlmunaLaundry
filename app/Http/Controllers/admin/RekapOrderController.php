<?php

namespace App\Http\Controllers\admin;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RekapOrderController extends Controller
{
    public function orderSelesai()
    {
        $listOrderSelesai = Transaksi::with(['Pelanggan.user', 'Service'])
            ->where('status_transaksi', 'selesai')
            ->paginate(10);

        return view('admin.rekap_order.order_selesai', compact('listOrderSelesai'));
    }
}
