<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Tampilkan semua kategori dan produk terbaru.
     */
    public function index()
    {
        $categories = Category::all();
        $products = \App\Models\Product::latest()->take(6)->get(); // Produk terbaru

        return view('hsnstudio.category.category', compact('categories', 'products'));
    }

    /**
     * Tampilkan produk berdasarkan kategori.
     */
    public function show($slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->latest()->get();

        return view('hsnstudio.category.category', compact('categories', 'products'));
    }
}
