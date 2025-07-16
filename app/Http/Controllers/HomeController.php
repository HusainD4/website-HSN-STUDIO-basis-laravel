<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil produk yang aktif saja dengan relasi category
        $products = Product::with('category')->where('is_active', 1)->get();

        return view('hsnstudio.homepage', compact('products'));
    }

}
