<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user();
        $pelanggan = $user->pelanggan;

        return view('profile.edit', compact('user', 'pelanggan'));
    }

    public function formEdit(Request $request)
    {
        $user = $request->user()->load('pelanggan');

        return view('profile.form_edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->only('name', 'email'));
        $user->save();

        $rawPhone = $request->input('no_telepon');
        $formattedPhone = $this->formatPhoneNumber($rawPhone);

        $pelanggan = $user->pelanggan;
        if ($pelanggan) {
            $pelanggan->update([
                'no_telepon' => $formattedPhone,
                'alamat' => $request->input('alamat'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
            ]);
        }
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    private function formatPhoneNumber($number)
    {
        // Hapus semua karakter selain angka
        $number = preg_replace('/[^0-9]/', '', $number);

        if (substr($number, 0, 1) === '0') {
            // Jika nomor diawali dengan 0, ganti 0 dengan 62 (kode negara Indonesia)
            $number = '62' . substr($number, 1);
        } elseif (substr($number, 0, 2) === '62') {
            // Sudah berformat benar, biarkan apa adanya
        } else {
            // Jika tidak diawali 0 atau 62, tambahkan 62 di depan
            $number = '62' . $number;
        }

        return $number;
    }
}
