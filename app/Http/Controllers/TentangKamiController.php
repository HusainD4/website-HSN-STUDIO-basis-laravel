<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function portofolio()
    {
        return view('hsnstudio.tentangkami.portofolio');
    }
    public function logoBrand()
    {
        return view('hsnstudio.tentangkami.logobrand');
    }
}
