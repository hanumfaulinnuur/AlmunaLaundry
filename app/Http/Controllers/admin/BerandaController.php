<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaksi;

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
            Transaksi::whereDate('tanggal_selesai', $tanggal)->whereNotNull('tanggal_selesai')->count()
        );

        $current->addDay();
    }

    return view('admin.beranda', compact('totalPelanggan','totalService', 'dates', 'orderMasuk', 'orderSelesai', 'start', 'end'));
}
}
