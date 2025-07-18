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
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        // Menampilkan form dari resources/views/hsnstudio/register.blade.php
        return view('hsnstudio.register');
    }

    /**
     * Menangani proses registrasi user baru (customer).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Buat user baru sebagai customer
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'customer',  // Asumsi kolom 'role' ada di tabel users
            'is_admin' => false,       // Asumsi kolom 'is_admin' ada di tabel users
        ]);

        // Trigger event jika menggunakan verifikasi email
        event(new Registered($user));

        // Login otomatis setelah berhasil registrasi
        Auth::login($user);

        // Redirect ke halaman utama (dashboard customer)
        return redirect('/')->with('success', 'Akun berhasil dibuat! Selamat datang.');
    }
}
