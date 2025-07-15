<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Tampilkan semua layanan (jasa)
    public function index()
    {
        $services = Service::latest()->get(); // Tampilkan jasa terbaru di atas
        return view('hsnstudio.product.jasakami.jasa', compact('services'));
    }

    // Tampilkan detail layanan (jasa) tertentu
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('hsnstudio.product.jasakami.detail', compact('service'));
    }
}
