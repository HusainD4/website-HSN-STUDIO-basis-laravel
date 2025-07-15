<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    // Tampilkan halaman portofolio
    public function portofolio()
    {
        return view('hsnstudio.tentangkami.portofolio');
    }

    // Tampilkan halaman logo brand
    public function logoBrand()
    {
        return view('hsnstudio.tentangkami.logobrand');
    }
}
