<?php

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
        // View login admin: resources/views/livewire/auth/login.blade.php
        return view('livewire.auth.login');
    }

    /**
     * Menangani proses login admin.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.',
            ]);
        }

        $user = Auth::user();

        if (! $user->is_admin) {
            Auth::logout();

            throw ValidationException::withMessages([
                'email' => 'Anda tidak memiliki akses sebagai admin.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Logout admin.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
