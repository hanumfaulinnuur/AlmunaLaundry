<?php

namespace App\Http\Controllers\admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::paginate(10);
        return view('admin.service.list_service', compact('service'));
    }

    public function create()
    {
        return view('admin.service.tambah_service');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_service' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
        ]);

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        return view('admin.service.edit_service', compact('service'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_service' => 'string',
            'deskripsi' => 'string',
            'harga' => 'numeric',
        ]);

        $service = Service::findOrFail($id);
        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
