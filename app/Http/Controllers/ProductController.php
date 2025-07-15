<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Tampil produk di frontend
    public function showProducts()
    {
        $products = Product::with('category')->latest()->get();
        return view('hsnstudio.product.product', compact('products'));
    }

    // Tampil detail produk di frontend
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('hsnstudio.product.show', compact('product'));
    }

    // Tampil halaman list produk di admin
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10); // Lebih baik pakai paginate
        return view('admin.product.admin_product', compact('products'));
    }

    // Form tambah produk di admin
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.add_product', compact('categories'));
    }

    // Simpan produk baru di admin
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'description' => 'required|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan file gambar ke storage/app/public/products
        $data['image'] = $request->file('image')->store('products', 'public');

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Form edit produk di admin
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit_product', compact('product', 'categories'));
    }

    // Update produk di admin
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate.');
    }

    // Hapus produk di admin
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar lama jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
