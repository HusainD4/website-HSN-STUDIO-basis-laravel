@extends('hsnstudio.layouts.app')

@section('title', 'Produk Kami - HSN Studio')

@section('content')
<div class="container content-page-container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center">
                <h2>Daftar Produk</h2>
            </div>

            @if($products->isEmpty())
                <p class="text-center mt-4">Oops! Produk belum tersedia saat ini. 💖</p>
            @else
                <div class="row mt-5">
                    @foreach($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('images/default-product.png') }}" class="card-img-top" alt="Default Product Image">
                                @endif

                                <div class="card-body d-flex flex-column text-center">
                                    <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                                    <p class="card-text small">{{ Str::limit($product->description, 120) }}</p>

                                    <div class="mt-auto">
                                        <p class="text-muted mb-2">
                                            <small>Kategori: {{ $product->category->name ?? 'Tidak diketahui' }}</small>
                                        </p>
                                        <p class="fw-bold fs-5" style="color: var(--soft-pink);">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </p>

                                        <a href="{{ route('produk.show', $product->id) }}"
                                           class="btn btn-primary btn-sm mt-2">
                                            Beli Sekarang
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
