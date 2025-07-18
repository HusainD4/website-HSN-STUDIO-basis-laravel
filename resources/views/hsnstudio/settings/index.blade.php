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
                <div class="list-group list-group-flush" id="settings-nav">
                    {{-- PERUBAHAN: Menghapus kelas 'active' dari HTML, akan dikontrol oleh JS --}}
                    <a href="#profil" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                        <i class="bi bi-person-fill me-2"></i>Profil
                    </a>
                    <a href="#keamanan" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                        <i class="bi bi-shield-lock-fill me-2"></i>Keamanan
                    </a>
                    <a href="#notifikasi" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                        <i class="bi bi-bell-fill me-2"></i>Notifikasi
                    </a>
                    <a href="#hapus-akun" class="list-group-item list-group-item-action text-danger" data-bs-toggle="tab">
                        <i class="bi bi-trash-fill me-2"></i>Hapus Akun
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                {{-- Konten Pengaturan Profil --}}
                {{-- PERUBAHAN: Menambahkan kelas 'show active' agar terlihat secara default --}}
                <div class="tab-pane fade show active" id="profil">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Profil Pengguna</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted">Perbarui informasi profil akun Anda.</p>
                            <hr class="my-4">
                            
                            <form method="POST" action="/settings/profile">
                                @csrf
                                @method('PATCH')

                                @if (session('status') === 'profil-updated')
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Profil berhasil diperbarui.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="mb-3 row">
                                    <label for="fullName" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="fullName" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-3 col-form-label">Alamat Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" readonly DISABLED>
                                        {{-- Tidak perlu validasi karena email tidak bisa diubah --}}
                                        <div class="form-text mt-2">Email tidak dapat diubah.</div>
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
                </div>

                {{-- Konten Pengaturan Keamanan --}}
                <div class="tab-pane fade" id="keamanan">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Keamanan</h4>
                        </div>
                        <div class="card-body">
                             <p class="card-text text-muted">Ubah kata sandi Anda.</p>
                             <hr class="my-4">
                             
                             <form method="POST" action="/settings/password">
                                 @csrf
                                 @method('PUT')

                                @if (session('status') === 'password-updated')
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Kata sandi berhasil diperbarui.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                 <div class="mb-3 row">
                                     <label for="current_password" class="col-sm-3 col-form-label">Kata Sandi Saat Ini</label>
                                     <div class="col-sm-9">
                                         <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="current_password" name="current_password" required>
                                         @error('current_password', 'updatePassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="password" class="col-sm-3 col-form-label">Kata Sandi Baru</label>
                                     <div class="col-sm-9">
                                         <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="password" name="password" required>
                                         @error('password', 'updatePassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="mb-3 row">
                                     <label for="password_confirmation" class="col-sm-3 col-form-label">Konfirmasi Kata Sandi</label>
                                     <div class="col-sm-9">
                                         <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
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
                
                {{-- Konten lainnya --}}
                <div class="tab-pane fade" id="notifikasi"><div class="card"><div class="card-body">Pengaturan notifikasi akan tersedia di sini.</div></div></div>
                <div class="tab-pane fade" id="hapus-akun"><div class="card"><div class="card-body">Pengaturan hapus akun akan tersedia di sini.</div></div></div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
@endsection

@push('scripts')
<script>
// JavaScript ini akan mengatur tab mana yang aktif
document.addEventListener('DOMContentLoaded', function () {
    function activateTabFromHash() {
        let hash = window.location.hash;

        // Logika untuk menentukan tab mana yang harus aktif berdasarkan error atau session
        @if ($errors->updatePassword->any() || session('status') === 'password-updated')
            hash = '#keamanan';
        @elseif ($errors->any() && !$errors->updatePassword->any() || session('status') === 'profil-updated')
             hash = '#profil';
        @endif

        // Jika ada hash di URL (misal: #keamanan), aktifkan tab tersebut
        if (hash) {
            const activeLink = document.querySelector(`#settings-nav a[href="${hash}"]`);
            if (activeLink) {
                const tab = new bootstrap.Tab(activeLink);
                tab.show();
            }
        } else {
            // Jika tidak ada hash, aktifkan tab pertama (Profil) secara default
            const firstLink = document.querySelector('#settings-nav a');
            if(firstLink) {
                const tab = new bootstrap.Tab(firstLink);
                tab.show();
            }
        }
    }

    // Panggil fungsi saat halaman dimuat
    activateTabFromHash();

    // Atur agar URL hash berubah saat tab diklik (tanpa reload)
    document.querySelectorAll('#settings-nav a').forEach(link => {
        link.addEventListener('shown.bs.tab', e => {
            // Gunakan 'replaceState' agar tidak memenuhi history browser
            history.replaceState(null, null, e.target.getAttribute('href'));
        });
    });

    // Dengarkan event tombol back/forward di browser
    window.addEventListener('popstate', activateTabFromHash);
});
</script>
@endpush
