@extends('hsnstudio.layouts.app')

@section('title', 'Kritik & Saran')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Kritik & Saran</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('kritiksaran.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan nama Anda" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="nama@email.com" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Pesan</label>
            <textarea name="message" class="form-control" id="message" rows="5" placeholder="Tuliskan kritik atau saran Anda di sini..." required></textarea>
            @error('message') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
    </form>
</div>
@endsection


