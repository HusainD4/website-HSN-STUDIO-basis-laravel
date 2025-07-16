<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    /**
     * Tampilkan form register custom.
     */
    public function showRegisterForm()
    {
        return view('hsnstudio.register'); 
    }

    /**
     * Proses register user biasa.
     */
     public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru dengan role default "user"
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // Login otomatis
        Auth::login($user);

        // Redirect ke homepage (pastikan route ini ada di web.php)
        return redirect()->route('homepage')->with('success', 'Akun berhasil dibuat!');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // 🛠️ Set role default sebagai user
        ]);

        Auth::login($user);

        return redirect()->route('homepage'); // Ubah jika kamu punya route user khusus
    }
}
