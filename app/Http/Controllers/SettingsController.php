<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    // Tampilkan halaman pengaturan user
    public function index()
    {
        return view('hsnstudio.settings.index');
    }
}
