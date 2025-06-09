<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Service;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BerandaController extends Controller
{
public function index(Request $request)
{
    $totalPelanggan = User::where('role', 'pelanggan')->count();
    $totalService = Service::count();

    $start = $request->start_date ? Carbon::parse($request->start_date)->startOfDay() : Carbon::now()->subDays(6)->startOfDay();
    $end = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : Carbon::now()->endOfDay();

    $dates = collect();
    $orderMasuk = collect();
    $orderSelesai = collect();

    $current = $start->copy();
    while ($current->lte($end)) {
        $tanggal = $current->format('Y-m-d');
        $dates->push($current->format('d M'));

        $orderMasuk->push(
            Transaksi::whereDate('tanggal_order', $tanggal)->count()
        );

        $orderSelesai->push(
            Pembayaran::whereDate('tanggal_pembayaran', $tanggal)->count()
        );

        $current->addDay();
    }

    return view('admin.beranda', compact('totalPelanggan','totalService', 'dates', 'orderMasuk', 'orderSelesai', 'start', 'end'));
}
}
