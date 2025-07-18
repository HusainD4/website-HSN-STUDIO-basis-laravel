<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class CategoryController extends Controller
{
    /**
     * Tampilkan semua kategori dan produk terbaru.
     */
    public function index()
    {
        $categories = Category::all();
        $products = \App\Models\Product::latest()->take(6)->get(); // Produk terbaru

        return view('hsnstudio.category.category', [
            'categories' => $categories,
            'products'   => $products,
            'selectedCategory' => null,
        ]);
    }

    /**
     * Tampilkan produk berdasarkan kategori.
     */
    public function show($slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->latest()->get();

        return view('hsnstudio.category.category', [
            'categories' => $categories,
            'products'   => $products,
            'selectedCategory' => $category,
        ]);
    }

    public function sync($id, Request $request)
    {
        $category = Category::findOrFail($id);  // ✅ Perbaikan disini

        $response = Http::post('https://api.phb-umkm.my.id/api/product-category/sync', [
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'seller_product_category_id' => (string) $category->id,
            'name' => $category->name,
            'description' => $category->description,
            'is_active' => $request->is_active == 1 ? false : true,
        ]);

        if ($response->successful() && isset($response['product_category_id'])) {
            $category->hub_category_id = $request->is_active == 1 ? null : $response['product_category_id'];
            $category->save();
        }

        session()->flash('successMessage', 'Category Synced Successfully');
        return redirect()->back();
    }

}
