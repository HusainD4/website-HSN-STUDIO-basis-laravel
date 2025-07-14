@extends('hsnstudio.layouts.app')

@section('title', 'Kategori Produk - HSN Studio')

@section('content')
<section class="section bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Kategori Produk</h2>

        <!-- List Kategori -->
        <div class="mb-4">
            <div class="d-flex flex-wrap gap-2 justify-content-center">
                @foreach ($categories as $cat)
                    <a href="{{ route('kategori.show', $cat->slug) }}" class="btn btn-outline-primary {{ request()->is('kategori/'.$cat->slug) ? 'active' : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Produk berdasarkan kategori -->
        <div class="row mt-4">
            @forelse ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $product->image_url ?? '/images/default-product.jpg' }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <a href="{{ route('produk.show', $product->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Produk belum tersedia dalam kategori ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
