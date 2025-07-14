<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all(); // ambil semua data gallery
        return view('hsnstudio.tentangkami.galerykami', compact('galleries'));
    }
}
