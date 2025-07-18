<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan halaman login user
    public function showLoginForm()
    {
        return view('hsnstudio.login'); // pastikan view ini ada
    }

    // Proses login user
    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login dengan credentials
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate(); // keamanan session

            // Redirect ke dashboard/user home jika ada, atau ke halaman sebelumnya
            return redirect()->intended('/dashboard');
        }

        // Jika login gagal, kembali ke form login dengan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Proses logout user
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama setelah logout
        return redirect('/');
    }
}