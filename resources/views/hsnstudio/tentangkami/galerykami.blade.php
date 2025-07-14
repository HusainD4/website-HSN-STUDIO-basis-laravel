@extends('hsnstudio.layouts.app')

@section('title', 'Galeri Kami - HSN Studio')

@section('content')
<div class="container content-page-container">
    <div class="text-center">
        <h2>Galeri Kami</h2>
        <p class="lead mb-5">Koleksi karya dan momen favorit kami.</p>
    </div>

    {{-- Galeri dengan 10 Gambar --}}
    <div class="gallery-grid">
        
        <!-- Gambar 1 -->
        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1579546929518-9e396f3cc809?q=80&w=2070&auto=format&fit=crop" alt="Gradien Warna Abstrak">
            <div class="overlay">
                <div class="overlay-text">Gradien Warna</div>
                <div class="overlay-icon"><i class="fas fa-search-plus"></i></div>
            </div>
        </div>

        <!-- Gambar 2 -->
        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1557682250-33bd709cbe85?q=80&w=2070&auto=format&fit=crop" alt="Gelombang Ungu Biru">
            <div class="overlay">
                <div class="overlay-text">Gelombang Neon</div>
                <div class="overlay-icon"><i class="fas fa-search-plus"></i></div>
            </div>
        </div>

        <!-- Gambar 3 -->
        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1500462918059-b1a0cb512f1d?q=80&w=1887&auto=format&fit=crop" alt="Kertas Warna Warni">
            <div class="overlay">
                <div class="overlay-text">Komposisi Kertas</div>
                <div class="overlay-icon"><i class="fas fa-search-plus"></i></div>
            </div>
        </div>

        <!-- Gambar 4 -->
        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1553356084-58ef4a67b2a7?q=80&w=1887&auto=format&fit=crop" alt="Cairan Pink Biru">
            <div class="overlay">
                <div class="overlay-text">Cairan Holografik</div>
                <div class="overlay-icon"><i class="fas fa-search-plus"></i></div>
            </div>
        </div>

        <!-- Gambar 5 -->
        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1528459801416-a9e53bbf4e17?q=80&w=1912&auto=format&fit=crop" alt="Cat Air Abstrak">
            <div class="overlay">
                <div class="overlay-text">Sapuan Cat Air</div>
                <div class="overlay-icon"><i class="fas fa-search-plus"></i></div>
            </div>
        </div>
        
        <!-- Gambar 6 -->
        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1557682224-5b8590cd9ec5?q=80&w=2029&auto=format&fit=crop" alt="Gradien Gelap">
            <div class="overlay">
                <div class="overlay-text">Gradien Gelap</div>
                <div class="overlay-icon"><i class="fas fa-search-plus"></i></div>
            </div>
        </div>

        <!-- GAMBAR BARU 7 -->
        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1536924940846-227afb31e2a5?q=80&w=2066&auto=format&fit=crop" alt="Lukisan Abstrak">
            <div class="overlay">
                <div class="overlay-text">Goresan Kuas</div>
                <div class="overlay-icon"><i class="fas fa-search-plus"></i></div>
            </div>
        </div>

        <!-- GAMBAR BARU 8 -->
        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1502691876148-a84978e59af8?q=80&w=2070&auto=format&fit=crop" alt="Bubuk Warna">
            <div class="overlay">
                <div class="overlay-text">Ledakan Warna</div>
                <div class="overlay-icon"><i class="fas fa-search-plus"></i></div>
            </div>
        </div>
        
        <!-- GAMBAR BARU 9 -->
        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1541701494587-cb58502866ab?q=80&w=2070&auto=format&fit=crop" alt="Cairan Warna">
            <div class="overlay">
                <div class="overlay-text">Aliran Cairan</div>
                <div class="overlay-icon"><i class="fas fa-search-plus"></i></div>
            </div>
        </div>

        <!-- GAMBAR BARU 10 -->
        <div class="gallery-item">
            <img src="https://images.unsplash.com/photo-1561212044-bac5ef68c65a?q=80&w=1887&auto=format&fit=crop" alt="Gelembung Sabun">
            <div class="overlay">
                <div class="overlay-text">Gelembung Makro</div>
                <div class="overlay-icon"><i class="fas fa-search-plus"></i></div>
            </div>
        </div>

    </div>
</div>
@endsection