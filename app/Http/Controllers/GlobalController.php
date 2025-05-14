<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function tentangKami()
    {
        return view('tentang_kami');
    }

    public function lacakStatus()
{
    $lacakStatus = Transaksi::with(['Pelanggan.user', 'Service'])->get();
    return view('lacak_status', compact('lacakStatus'));
}


}
