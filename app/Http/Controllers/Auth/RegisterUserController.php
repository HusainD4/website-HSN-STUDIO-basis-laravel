<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

class RegisterUserController extends Controller
{
    /**
     * Menampilkan form registrasi untuk customer.
     */
    public function showRegisterForm()
    {
        return view('hsnstudio.register'); 
    }

    /**
     * Menangani permintaan registrasi dari form.
     * Metode ini menggabungkan logika dari 'register' dan 'store'.
     */
    public function store(Request $request)
    {
        // Validasi input dengan standar Laravel terbaru
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // --- BAGIAN INI DIPERBAIKI ---
        // Membuat user baru dengan peran 'customer' secara eksplisit.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // Peran diubah dari 'user' menjadi 'customer'
        ]);

        // Memicu event 'Registered' (untuk notifikasi, verifikasi email, dll.)
        event(new Registered($user));

        // Login otomatis setelah registrasi berhasil
        Auth::login($user);

        // Arahkan ke dashboard setelah login
        return redirect('/dashboard')->with('success', 'Akun berhasil dibuat! Selamat datang.');
    }
}
