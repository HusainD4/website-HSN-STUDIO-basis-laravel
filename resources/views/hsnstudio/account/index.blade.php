@extends('hsnstudio.layouts.app')

@section('title', 'Akun Saya')

@section('content')
<div class="container mt-4">
    <h2>Profil Pengguna</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ auth()->user()->name ?? '-' }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email ?? '-' }}</p>
            {{-- Tambah kolom lain sesuai tabel pengguna --}}
        </div>
    </div>
</div>
@endsection
