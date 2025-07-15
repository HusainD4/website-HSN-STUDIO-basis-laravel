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

                        <!-- Tombol trigger modal -->
                        <button type="button" id="buyNowBtn" class="btn btn-success">
                            🛍️ Beli Sekarang
                        </button>
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

<!-- Modal Checkout -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('cart.checkout') }}" method="POST" class="modal-content">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" id="modalQuantity" value="1">

            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Form Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone">Nomor HP</label>
                    <input type="text" class="form-control" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="address">Alamat</label>
                    <textarea class="form-control" name="address" rows="3" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Proses Checkout</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var buyNowBtn = document.getElementById('buyNowBtn');
        var quantityInput = document.getElementById('quantity');
        var modalQuantity = document.getElementById('modalQuantity');

        buyNowBtn.addEventListener('click', function () {
            // Ambil jumlah dari input dan set ke hidden modal input
            modalQuantity.value = quantityInput.value || 1;

            // Tampilkan modal Bootstrap (pastikan bootstrap.bundle.js sudah di-include)
            var checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
            checkoutModal.show();
        });
    });
</script>
@endpush
