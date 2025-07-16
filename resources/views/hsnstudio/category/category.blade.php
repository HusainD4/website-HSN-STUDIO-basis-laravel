@extends('hsnstudio.layouts.app')

@section('title', 'Kategori Produk - HSN Studio')

@section('content')
<div class="container content-page-container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Judul Kategori -->
            <div class="text-center mb-4">
                <h2>
                    HALAMAN: 
                    {{ isset($currentCategory) ? $currentCategory->name : ' KATEGORI PRODUK KAMI' }}
                </h2>
            </div>

            <!-- Filter Kategori -->
            <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
                {{-- Tombol Semua Kategori --}}
                <a href="{{ route('kategori.index') }}" 
                   class="btn btn-outline-primary {{ request()->is('kategori') ? 'active' : '' }}">
                    Semua Kategori
                </a>

                {{-- Tombol kategori yang memiliki produk --}}
                @foreach ($categories as $cat)
                    @if ($cat->products->isNotEmpty())
                        <a href="{{ route('kategori.show', $cat->slug) }}" 
                           class="btn btn-outline-primary {{ request()->is('kategori/'.$cat->slug) ? 'active' : '' }}">
                            {{ $cat->name }}
                        </a>
                    @endif
                @endforeach
            </div>

            <!-- Daftar Produk -->
            @if($products->isEmpty())
                <p class="text-center mt-4">Oops! Produk belum tersedia dalam kategori ini. 💖</p>
            @else
                <div class="row mt-3">
                    @foreach($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         class="card-img-top"
                                         alt="{{ $product->name }}"
                                         style="aspect-ratio: 16/9; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/default-product.png') }}"
                                         class="card-img-top"
                                         alt="Default Product Image"
                                         style="aspect-ratio: 16/9; object-fit: cover;">
                                @endif

                                <div class="card-body d-flex flex-column text-center">
                                    <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                                    <p class="card-text small">{{ Str::limit($product->description, 100) }}</p>

                                    <div class="mt-auto">
                                        <p class="text-muted mb-2">
                                            <small>Kategori: {{ $product->category->name ?? 'Tidak diketahui' }}</small>
                                        </p>
                                        <p class="fw-bold fs-5" style="color: var(--soft-pink);">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </p>

                                        <a href="{{ route('produk.show', $product->id) }}" 
                                           class="btn btn-primary btn-sm mt-2">
                                            Lihat Detail
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
