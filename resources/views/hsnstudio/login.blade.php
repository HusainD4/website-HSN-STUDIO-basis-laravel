@extends('hsnstudio.layouts.app')

@section('title', 'Login')

@section('content')
<div class="container mt-5" style="max-width: 400px;">
    <h2 class="mb-4 text-center">Masuk ke HSN Studio</h2>

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('user.login') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan kata sandi" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Ingat Saya</label>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Masuk</button>
        </div>
    </form>
</div>
@endsection
