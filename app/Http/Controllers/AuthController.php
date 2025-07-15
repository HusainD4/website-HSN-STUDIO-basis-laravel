<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('hsnstudio.login');
    }

    /**
     * Proses login user
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kredensial
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Arahkan user ke halaman utama (homepage)
            return redirect()->intended('/');
        }

        // Jika gagal
        return back()->with('error', 'Email atau password salah');
    }

    /**
     * Tampilkan halaman register
     */
    public function showRegisterForm()
    {
        return view('hsnstudio.register');
    }

    /**
     * Proses registrasi user
     */
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        // Simpan user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login otomatis
        Auth::login($user);

        // Redirect ke homepage
        return redirect('/');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
