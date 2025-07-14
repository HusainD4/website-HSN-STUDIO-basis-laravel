@extends('hsnstudio.layouts.app')

@section('title', $product->name . ' - Detail Produk')

@section('content')
<section class="section bg-white py-5">
    <div class="container">
        <div class="row">
            <!-- Gambar Produk -->
            <div class="col-md-6 mb-4">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         class="img-fluid rounded" 
                         alt="{{ $product->name }}">
                @else
                    <img src="{{ asset('/images/default-product.jpg') }}" 
                         class="img-fluid rounded" 
                         alt="Default Produk">
                @endif
            </div>

            <!-- Detail Produk -->
            <div class="col-md-6">
                <h2>{{ $product->name }}</h2>
                <p class="text-muted">Kategori: <strong>{{ $product->category->name ?? '-' }}</strong></p>
                <p class="text-muted">Brand: <strong>{{ $product->brand ?? '-' }}</strong></p>
                <h4 class="text-primary mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>

                <p>{{ $product->description }}</p>

                <!-- Form Masukkan ke Keranjang -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah:</label>
                        <input type="number" name="quantity" id="quantity" min="1" value="1" class="form-control w-25" required>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary">
                            🛒 Masukkan ke Keranjang
                        </button>

                        <a href="{{ url('/checkout?product_id=' . $product->id . '&quantity=1') }}" 
                           class="btn btn-success">
                            🛍️ Beli Sekarang
                        </a>
                    </div>
                </form>

                <!-- Tombol kembali -->
                <a href="{{ url('/produk') }}" class="btn btn-outline-secondary mt-4">
                    ← Kembali ke Daftar Produk
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
