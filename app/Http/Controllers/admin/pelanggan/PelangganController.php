<?php

namespace App\Http\Controllers\admin\pelanggan;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $pelanggan = User::with('pelanggan')
            ->where('role', 'pelanggan')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);
        return view('admin.pelanggan.list_pelanggan', compact('pelanggan'));
    }

    public function create()
    {
        return view('admin.pelanggan.tambah_pelanggan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $Pelanggan = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'),
            'role' => 'pelanggan',
        ]);

        Pelanggan::create([
            'id_user' => $Pelanggan->id,
        ]);

        return redirect()->route('list.pelanggan')->with('success', 'Pelanggan berhasil ditambahkan.');
    }
}
