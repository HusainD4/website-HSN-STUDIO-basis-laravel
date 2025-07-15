<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout berdasarkan product_id dan quantity dari query string
    public function index(Request $request)
    {
        $productId = $request->query('product_id');
        $quantity = (int) $request->query('quantity', 1);

        // Cari produk, jika tidak ditemukan akan error 404 otomatis
        $product = Product::findOrFail($productId);

        // Tampilkan view checkout, kirim data produk dan quantity
        return view('checkout.index', compact('product', 'quantity'));
    }

    // Proses tambah produk ke keranjang (session)
    public function process(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        // Cari produk terkait
        $product = Product::findOrFail($request->product_id);

        // Ambil isi keranjang dari session, jika belum ada buat array kosong
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            // Jika produk sudah ada di keranjang, tambahkan quantity-nya
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            // Jika belum ada, buat item baru di keranjang
            $cart[$product->id] = [
                "name"     => $product->name,
                "quantity" => $request->quantity,
                "price"    => $product->price,
                "image"    => $product->image,
            ];
        }

        // Simpan kembali ke session
        session()->put('cart', $cart);

        // Redirect ke halaman keranjang dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }
}
