<?php

// Pastikan namespace-nya benar sesuai lokasi file
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    /**
     * Menampilkan form login untuk admin.
     */
    public function showLoginForm()
    {
        // Pastikan view ini ada di resources/views/admin/login.blade.php
        return view('admin.login');
    }

    /**
     * Menangani permintaan login dari admin.
     */
    public function login(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba lakukan otentikasi menggunakan guard standar ('web')
        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            // Jika kredensial salah, kirim kembali dengan pesan error
            throw ValidationException::withMessages([
                'email' => 'Email atau password yang Anda masukkan salah.',
            ]);
        }

        // 3. Jika kredensial benar, periksa apakah pengguna adalah admin
        //    (Asumsi ada kolom 'is_admin' di tabel users)
        if (! $request->user()->is_admin) { // <-- PENTING: Ganti 'is_admin' jika nama kolom Anda berbeda
            // Jika bukan admin, langsung logout lagi
            Auth::logout();

            // Kirim pesan error bahwa mereka tidak punya akses
            throw ValidationException::withMessages([
                'email' => 'Anda tidak memiliki hak akses sebagai admin.',
            ]);
        }

        // 4. Jika berhasil login dan merupakan admin, regenerate session
        $request->session()->regenerate();

        // 5. Arahkan ke dashboard admin
        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Menangani permintaan logout dari admin.
     */
    public function logout(Request $request)
    {
        // Gunakan guard standar untuk logout
        Auth::logout();

        // Invalidate session dan regenerate token untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman login admin
        return redirect()->route('admin.login');
    }
}
