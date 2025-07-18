@extends('hsnstudio.layouts.app')

@section('title', 'Keranjang Belanja')

{{-- Menambahkan Font Awesome untuk ikon --}}
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" xintegrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<style>
    /* Menggunakan font yang lebih modern */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }

    .cart-container {
        max-width: 1200px;
    }

    .cart-header {
        color: #343a40;
        font-weight: 700;
        border-bottom: 2px solid #dee2e6;
        padding-bottom: 0.5rem;
    }

    /* Styling untuk tabel produk di keranjang */
    .cart-table {
        background-color: #fff;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .cart-table thead {
        background-color: #f1f3f5;
        color: #495057;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.85rem;
    }

    .cart-table td, .cart-table th {
        border: none;
        vertical-align: middle;
        padding: 1.25rem 1rem;
    }

    .cart-table tbody tr {
        border-bottom: 1px solid #f1f3f5;
    }

    .cart-table tbody tr:last-child {
        border-bottom: none;
    }

    /* Info produk dengan gambar */
    .product-info {
        display: flex;
        align-items: center;
    }

    .product-info img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 0.5rem;
        margin-right: 1rem;
    }

    .product-info .product-details {
        font-weight: 600;
        color: #343a40;
    }

    /* Input kuantitas yang lebih interaktif */
    .quantity-input {
        max-width: 120px;
    }
    .quantity-input .form-control {
        text-align: center;
        border-left: none;
        border-right: none;
    }
    .quantity-input .btn {
        border-color: #ced4da;
    }

    /* Tombol hapus dengan ikon */
    .btn-remove {
        color: #dc3545;
        background: none;
        border: none;
        font-size: 1.2rem;
        transition: color 0.2s;
    }
    .btn-remove:hover {
        color: #a4202e;
    }

    /* Ringkasan Pesanan */
    .order-summary {
        background-color: #fff;
        border-radius: 0.75rem;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .order-summary h4 {
        font-weight: 700;
        color: #343a40;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 1rem;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        font-size: 1rem;
    }

    .summary-item .label {
        color: #6c757d;
    }

    .summary-item .value {
        font-weight: 600;
        color: #343a40;
    }

    .summary-total {
        border-top: 1px solid #e9ecef;
        padding-top: 1rem;
        margin-top: 1rem;
    }

    .summary-total .value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #db2777; /* Warna pink dari style asli */
    }

    /* Tombol Aksi */
    .btn-checkout {
        background: linear-gradient(45deg, #db2777, #f35a94);
        border: none;
        font-weight: 600;
        width: 100%;
        padding: 0.8rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-checkout:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 20px rgba(219, 39, 119, 0.25);
    }

    .btn-clear-cart {
        color: #dc3545;
        font-weight: 600;
    }
    .btn-clear-cart:hover {
        background-color: #f8d7da;
    }

    /* Tampilan keranjang kosong */
    .cart-empty {
        text-align: center;
        padding: 4rem 2rem;
        background-color: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }
    .cart-empty i {
        font-size: 4rem;
        color: #e9ecef;
    }
    .cart-empty p {
        font-size: 1.2rem;
        color: #6c757d;
        margin-top: 1.5rem;
        margin-bottom: 2rem;
    }
    .btn-shop-now {
        background-color: #db2777;
        color: #fff;
        font-weight: 600;
        padding: 0.75rem 2rem;
    }

</style>

<div class="container cart-container py-5">
    <h2 class="mb-4 cart-header">Keranjang Saya</h2>

    @if(session('cart') && count(session('cart')))
        <div class="row">
            {{-- Kolom Kiri: Daftar Produk --}}
            <div class="col-lg-8">
                <div class="cart-table">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col" class="text-center">Jumlah</th>
                                <th scope="col" class="text-end">Total</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach(session('cart') as $id => $item)
                                @php
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="product-info">
                                            {{-- Ganti dengan URL gambar produk Anda --}}
                                            <img src="{{ $item['image'] ?? 'https://placehold.co/80x80/f0f0f0/333?text=Produk' }}" alt="{{ $item['name'] }}">
                                            <span class="product-details">{{ $item['name'] }}</span>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        {{-- Form untuk update kuantitas (memerlukan logika backend) --}}
                                        <div class="input-group quantity-input mx-auto">
                                            <button class="btn btn-outline-secondary" type="button">-</button>
                                            <input type="text" class="form-control" value="{{ $item['quantity'] }}" readonly>
                                            <button class="btn btn-outline-secondary" type="button">+</button>
                                        </div>
                                    </td>
                                    <td class="text-end">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-remove"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Kolom Kanan: Ringkasan Pesanan --}}
            <div class="col-lg-4">
                <div class="order-summary">
                    <h4>Ringkasan Pesanan</h4>
                    <div class="summary-item">
                        <span class="label">Subtotal</span>
                        <span class="value">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-item">
                        <span class="label">Pengiriman</span>
                        <span class="value">Gratis</span>
                    </div>
                    <div class="summary-item summary-total">
                        <span class="label">Total</span>
                        <span class="value">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <button class="btn btn-primary btn-checkout mt-4" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                        Lanjut ke Checkout
                    </button>

                    <div class="text-center mt-3">
                        <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link btn-clear-cart">Kosongkan Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="cart-empty">
            <i class="fas fa-shopping-cart"></i>
            <p>Keranjang belanja Anda masih kosong.</p>
            <a href="{{ url('/produk') }}" class="btn btn-shop-now">Mulai Belanja</a>
        </div>
    @endif
</div>

<!-- Modal Checkout (Styling disesuaikan dengan tema baru) -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('cart.checkout') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Formulir Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor HP</label>
                    <input type="text" class="form-control" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat Lengkap</p>
                    <textarea class="form-control" name="address" rows="3" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-checkout">Proses Pesanan</button>
            </div>
        </form>
    </div>
</div>

@endsection
