@extends('hsnstudio.layouts.app')

@section('title', 'Portofolio - HSN Studio')

@section('content')
    <section class="section bg-white text-center">
        <div class="container">
            <h2 class="mb-4">Portofolio Kami</h2>
            <p class="lead mb-5">Berikut adalah beberapa hasil karya terbaik dari HSN Studio dalam bidang desain grafis, web development, dan produksi konten.</p>

            <div class="row">
                <!-- Portofolio Item 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('images/portfolio1.jpg') }}" class="card-img-top" alt="Project 1">
                        <div class="card-body">
                            <h5 class="card-title">Brand Identity</h5>
                            <p class="card-text">Desain logo dan branding untuk perusahaan startup teknologi.</p>
                        </div>
                    </div>
                </div>

                <!-- Portofolio Item 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('images/portfolio2.jpg') }}" class="card-img-top" alt="Project 2">
                        <div class="card-body">
                            <h5 class="card-title">Website Toko Online</h5>
                            <p class="card-text">Pengembangan e-commerce modern dengan fitur cart dan pembayaran online.</p>
                        </div>
                    </div>
                </div>

                <!-- Portofolio Item 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('images/portfolio3.jpg') }}" class="card-img-top" alt="Project 3">
                        <div class="card-body">
                            <h5 class="card-title">Konten Sosial Media</h5>
                            <p class="card-text">Produksi konten visual untuk kampanye media sosial fashion brand lokal.</p>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ url('/') }}" class="btn btn-primary mt-4">Kembali ke Beranda</a>
        </div>
    </section>
@endsection
