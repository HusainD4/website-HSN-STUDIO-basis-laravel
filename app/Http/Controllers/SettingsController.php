<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    /**
     * Menampilkan halaman utama pengaturan.
     */
    public function index()
    {
        return view('hsnstudio.settings.index');
    }

    /**
     * Memperbarui informasi profil pengguna.
     */
    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        // Ambil user yang sedang login
        $user = $request->user();

        // Update nama
        $user->name = $request->name;
        $user->save();

        // Redirect kembali dengan pesan sukses
        return back()->with('status', 'profil-updated');
    }

    /**
     * Memperbarui kata sandi pengguna.
     */
    public function updatePassword(Request $request)
    {
        // Validasi input, termasuk mengecek password saat ini
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Update password baru
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Redirect kembali dengan pesan sukses
        return back()->with('status', 'password-updated');
    }
}
