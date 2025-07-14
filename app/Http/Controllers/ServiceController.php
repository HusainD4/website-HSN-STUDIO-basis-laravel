<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('hsnstudio.product.jasakami.jasa', compact('services'));
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('hsnstudio.product.jasakami.detail', compact('service'));
    }
}
