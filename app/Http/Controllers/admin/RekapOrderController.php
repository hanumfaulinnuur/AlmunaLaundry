<?php

namespace App\Http\Controllers\admin;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RekapOrderController extends Controller
{
    public function orderSelesai(Request $request)
    {
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $listOrderSelesai = Transaksi::with(['Pelanggan.user', 'Service', 'Pembayaran'])
            ->where('status_transaksi', 'selesai')
            ->when($search, function ($query, $search) {
                $query->whereHas('Pelanggan.user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->when($startDate, function ($query, $startDate) {
                $query->whereDate('tanggal_selesai', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                $query->whereDate('tanggal_selesai', '<=', $endDate);
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.rekap_order.order_selesai', compact('listOrderSelesai'));
    }

    public function orderDetail(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $query = Transaksi::with(['Pelanggan.user', 'Service'])
        ->where('status_transaksi', 'selesai');

    if ($startDate) {
        $query->whereDate('tanggal_selesai', '>=', $startDate);
    }

    if ($endDate) {
        $query->whereDate('tanggal_selesai', '<=', $endDate);
    }

    $listOrderDetail = $query->get();
    $totalOrderMasuk = Transaksi::where('status_transaksi', '!=', null);
    if ($startDate) $totalOrderMasuk->whereDate('tanggal_order', '>=', $startDate);
    if ($endDate) $totalOrderMasuk->whereDate('tanggal_order', '<=', $endDate);
    $totalOrderMasuk = $totalOrderMasuk->count();

    $totalOrderSelesai = $listOrderDetail->count();

    $totalPendapatan = $listOrderDetail->sum('total_harga');

    return view('admin.rekap_order.detail_rekap_order', compact(
        'listOrderDetail',
        'totalOrderMasuk',
        'totalOrderSelesai',
        'totalPendapatan',
        'startDate',
        'endDate'
    ));
}

}
