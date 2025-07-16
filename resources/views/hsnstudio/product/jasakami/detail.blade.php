@extends('hsnstudio.layouts.app')

@section('title', 'Detail Jasa')

@section('content')
<div class="container py-5">
    <a href="{{ route('jasa.index') }}" class="btn btn-secondary mb-4">
        &larr; Kembali ke Daftar Jasa
    </a>

    <h1 class="mb-4">{{ $service->name ?? 'Judul Jasa' }}</h1>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $service->image_url) }}" class="img-fluid rounded" alt="{{ $service->name }}">
        </div>
        <div class="col-md-6">
            <h4>Deskripsi:</h4>
            <p>{{ $service->description ?? '-' }}</p>
            <p><strong>Harga: </strong>Rp {{ number_format($service->price ?? 0, 0, ',', '.') }}</p>

            {{-- Tombol Booking Sekarang --}}
            <a href="https://wa.me/6282127820980?text=Halo%20saya%20ingin%20booking%20jasa%20{{ urlencode($service->name) }}" 
               target="_blank" 
               class="btn btn-success mt-4">
                Booking Sekarang via WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection
