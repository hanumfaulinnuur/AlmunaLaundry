<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Pelanggan;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $pelanggan = $user->pelanggan;

        return view('profile.edit', [
            'user' => $user,
            'pelanggan' => $pelanggan,
        ]);
    }

    public function formEdit(Request $request)
    {
        $user = $request->user()->load('pelanggan');

        return view('profile.form_edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Update data user
        $user->fill($request->only('name', 'email'));
        $user->save();

        // Update data pelanggan
        $pelanggan = $user->pelanggan;
        if ($pelanggan) {
            $pelanggan->update([
                'no_telepon' => $request->input('no_telepon'),
                'alamat' => $request->input('alamat'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
            ]);
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
}
