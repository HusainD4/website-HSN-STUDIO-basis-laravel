<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Tampil produk di frontend (hanya yang aktif)
    public function showProducts()
    {
        // Ambil produk aktif dengan relasi category, urut terbaru
        $products = Product::with('category')->where('is_active', 1)->latest()->get();

        return view('hsnstudio.product.product', compact('products'));
    }

    // Tampil detail produk di frontend
    public function show($id)
    {
        // Pastikan produk aktif dan ada
        $product = Product::with('category')
            ->where('is_active', 1)
            ->findOrFail($id);

        return view('hsnstudio.product.show', compact('product'));
    }

    // Tampil halaman list produk di admin (semua produk, termasuk yang tidak aktif)
    public function index()
    {
        // Ambil semua produk tanpa filter is_active supaya admin bisa kelola
        $products = Product::with('category')->latest()->get();

        return view('produk.index', compact('products'));
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
            'is_active'   => 'required|boolean', // tambahkan validasi is_active
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
            'is_active'   => 'required|boolean', // tambahkan validasi is_active
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
