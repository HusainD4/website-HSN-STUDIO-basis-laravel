@extends('hsnstudio.layouts.app')

{{-- Menambahkan judul khusus untuk halaman ini --}}
@section('title', 'Pengaturan Akun')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-3">
            {{-- Menu Navigasi Samping --}}
            <div class="card">
                <div class="card-header fw-bold">
                    Menu Pengaturan
                </div>
                <div class="list-group list-group-flush">
                    <a href="#profil" class="list-group-item list-group-item-action active" aria-current="true">
                        <i class="bi bi-person-fill me-2"></i>Profil
                    </a>
                    <a href="#keamanan" class="list-group-item list-group-item-action">
                        <i class="bi bi-shield-lock-fill me-2"></i>Keamanan
                    </a>
                    <a href="#notifikasi" class="list-group-item list-group-item-action">
                        <i class="bi bi-bell-fill me-2"></i>Notifikasi
                    </a>
                    <a href="#hapus-akun" class="list-group-item list-group-item-action text-danger">
                        <i class="bi bi-trash-fill me-2"></i>Hapus Akun
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            {{-- Konten Pengaturan Profil --}}
            <div class="card" id="profil">
                <div class="card-header">
                    <h4 class="card-title mb-0">Profil Pengguna</h4>
                </div>
                <div class="card-body">
                    <p class="card-text text-muted">Perbarui informasi profil dan alamat email akun Anda.</p>
                    <hr class="my-4">
                    <form>
                        <div class="mb-4 row align-items-center">
                            <label class="col-sm-3 col-form-label">Foto Profil</label>
                            <div class="col-sm-9 d-flex align-items-center">
                                <img src="https://placehold.co/80x80/EFEFEF/A9A9A9?text={{ auth()->user() ? mb_substr(auth()->user()->name, 0, 2) : 'HS' }}" alt="Avatar" class="rounded-circle me-3">
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm">Unggah Foto</button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm">Hapus</button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="fullName" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="fullName" value="{{ auth()->user()->name ?? 'Nama Pengguna' }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-3 col-form-label">Alamat Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" value="{{ auth()->user()->email ?? 'email@contoh.com' }}" readonly>
                                <div class="form-text">Email tidak dapat diubah.</div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Konten Pengaturan Keamanan --}}
            <div class="card mt-4" id="keamanan">
                <div class="card-header">
                    <h4 class="card-title mb-0">Keamanan</h4>
                </div>
                <div class="card-body">
                     <p class="card-text text-muted">Ubah kata sandi Anda untuk menjaga keamanan akun.</p>
                     <hr class="my-4">
                     <form>
                        <div class="mb-3 row">
                            <label for="currentPassword" class="col-sm-3 col-form-label">Kata Sandi Saat Ini</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="currentPassword">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="newPassword" class="col-sm-3 col-form-label">Kata Sandi Baru</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="newPassword">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="confirmPassword" class="col-sm-3 col-form-label">Konfirmasi Kata Sandi</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="confirmPassword">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-success">Ubah Kata Sandi</button>
                            </div>
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Menambahkan ikon Bootstrap --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
