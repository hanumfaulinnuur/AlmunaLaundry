<?php

namespace App\Http\Controllers\admin\pelanggan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PelangganController extends Controller
{

    public function index()
{
    $pelanggan = User::where('role', 'pelanggan')->get();
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

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt('password'),
        'role' => 'pelanggan',
    ]);

    return redirect()->route('list.pelanggan');
}


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
