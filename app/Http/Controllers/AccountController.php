<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Menampilkan halaman akun pengguna yang sedang login.
     */
    public function index()
    {
        // Mengambil data pengguna yang sedang login menggunakan guard standar.
        // Tidak perlu lagi menggunakan Auth::guard('pengguna')
        $user = Auth::user();

        return view('hsnstudio.account.index', compact('user'));
    }
}
