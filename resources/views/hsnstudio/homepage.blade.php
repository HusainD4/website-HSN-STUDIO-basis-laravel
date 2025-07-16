@extends('hsnstudio.layouts.app')

@section('title', 'Beranda - HSN Studio')

@section('content')
    <section class="hero d-flex justify-content-center align-items-center">
        <div class="text-center">
            <h1>Selamat Datang di HSN Studio</h1>
            <p>Solusi kreatif untuk kebutuhan digital Anda</p>
            <a href="#layanan" class="btn btn-primary mt-3">Lihat Layanan Kami</a>
        </div>
    </section>

    <section class="section text-center" id="tentang">
        <div class="text-center my-4">
            <img src="{{ asset('images/LogoHsnStudio.png') }}" alt="Logo HSN Studio" style="max-width: 200px;">
        </div>
        <div class="container">
            <h2 class="mb-4">Tentang Kami</h2>
            <p class="lead">HSN Studio adalah studio kreatif yang menyediakan layanan desain grafis, pengembangan web, dan produksi konten digital.</p>
        </div>
    </section>

    <section class="section" id="layanan">
        <div class="container">
            <div class="text-center">
                <h2 class="mb-5">Layanan Kami</h2>
            </div>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="icon"><i class="fas fa-paint-brush"></i></div>
                    <h4>Desain Grafis</h4>
                    <p>Logo, brosur, poster, dan identitas visual lainnya untuk bisnis Anda.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="icon"><i class="fas fa-code"></i></div>
                    <h4>Pengembangan Web</h4>
                    <p>Membangun website modern, responsif, dan mudah digunakan.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="icon"><i class="fas fa-camera-retro"></i></div>
                    <h4>Produksi Konten</h4>
                    <p>Video promosi, fotografi produk, dan konten sosial media.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="produk">
        <div class="container">
            <div class="text-center">
                 <h2 class="mb-5">Produk Kami</h2>
            </div>

            @if($products->isEmpty())
                <p class="text-center">Produk belum tersedia.</p>
            @else
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('images/default-product.png') }}" class="card-img-top" alt="Default Product Image">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                    <p class="text-muted"><small>Kategori: {{ $product->category->name ?? 'Tidak diketahui' }}</small></p>
                                    <p class="fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="section text-center" id="kontak">
        <div class="container">
            <h2>Hubungi Kami</h2>
            <p>Email: info@hsnstudio.com | Telp: 0812-3456-7890</p>
        </div>
    </section>
@endsection