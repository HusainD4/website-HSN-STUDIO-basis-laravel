<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('hsnstudio.login'); // pastikan path view sudah benar
    }

    // Proses login user
    public function login(Request $request)
    {
        // Validasi inputan login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login dengan credentials tersebut
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // regenerasi session untuk keamanan

            // Redirect ke halaman yang diinginkan (homepage/dashboard)
            return redirect()->intended('/');
        }

        // Jika login gagal, kembali ke form login dengan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Proses logout user
    public function logout(Request $request)
    {
        Auth::logout(); // logout user

        // Invalidasi session dan regenerasi CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama setelah logout
        return redirect('/');
    }
}
