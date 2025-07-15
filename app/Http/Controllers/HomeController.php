<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil produk terbaru, misal 6 produk terakhir
        $products = Product::with('category')->latest()->take(6)->get();

        return view('hsnstudio.homepage', compact('products'));
    }
}
