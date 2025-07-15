<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Coba login menggunakan guard 'admin'
    if (Auth::guard('admin')->attempt($credentials)) {
        
        // --> TAMBAHKAN PENGECEKAN INI
        $user = Auth::guard('admin')->user();
        if ($user->role !== 'admin') {
            // Jika role pengguna bukan admin, langsung logout
            Auth::guard('admin')->logout();
            return back()->withErrors([
                'email' => 'Anda tidak memiliki hak akses sebagai admin.',
            ])->onlyInput('email');
        }
        // <-- AKHIR DARI PENGECEKAN

        $request->session()->regenerate();
        return redirect()->intended('/admin/dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah untuk admin.',
    ])->onlyInput('email');
}

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Mengarahkan ke halaman login admin, bukan pengguna
        return redirect()->route('admin.login');
    }
}