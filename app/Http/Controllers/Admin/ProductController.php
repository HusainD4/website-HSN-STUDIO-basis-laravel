<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil semua produk dengan relasi kategori
        $products = Product::with('category')->get();
        return view('admin.product.admin_product', compact('products'));
    }

    public function create()
    {
        // Ambil semua kategori untuk dropdown
        $categories = \App\Models\Category::all();
        return view('admin.product.add_product', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Simpan file di storage/app/public/products dan simpan path relatif di DB
            $file = $request->file('image');
            $filename = Str::slug($data['name']) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/products', $filename);
            $data['image'] = 'products/' . $filename;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(int $id)
    {
        $product = Product::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('admin.product.edit_product', compact('product', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }

            // Simpan gambar baru
            $file = $request->file('image');
            $filename = Str::slug($validated['name']) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/products', $filename);
            $validated['image'] = 'products/' . $filename;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);

        // Hapus file gambar jika ada
        if ($product->image && Storage::exists('public/' . $product->image)) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus');
    }
}
