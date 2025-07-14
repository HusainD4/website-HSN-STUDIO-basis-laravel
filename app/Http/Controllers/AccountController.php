<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::guard('pengguna')->user(); // gunakan guard sesuai auth pengguna
        return view('hsnstudio.account.index', compact('user'));
    }
}
