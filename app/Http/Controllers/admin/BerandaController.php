<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BerandaController extends Controller
{
    public function index()
    {
        $totalPelanggan = User::where('role', 'pelanggan')->count();
        return view('admin.beranda', compact('totalPelanggan'));
    }
}
