@extends('hsnstudio.layouts.app')

@section('title', 'Akun Saya')

@section('content')
<style>
    /* Profil Pengguna - Styling Keren */
    .profile-container {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
    }

    .profile-card {
        background: linear-gradient(to right, #e0f2ff, #f8fbff);
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.1);
        padding: 30px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }

    .profile-icon {
        flex: 0 0 100px;
        height: 100px;
        background: #007bff;
        border-radius: 50%;
        color: #fff;
        font-size: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 25px;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4);
    }

    .profile-details {
        flex: 1;
    }

    .profile-details h2 {
        font-size: 26px;
        color: #007bff;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .profile-details p {
        font-size: 16px;
        color: #333;
        margin: 6px 0;
    }

    .profile-details p strong {
        color: #000;
        font-weight: 600;
    }

    @media screen and (max-width: 576px) {
        .profile-card {
            flex-direction: column;
            align-items: flex-start;
        }

        .profile-icon {
            margin: 0 auto 20px;
        }

        .profile-details h2 {
            text-align: center;
            width: 100%;
        }
    }
</style>

<div class="profile-container">
    <div class="profile-card">
        <div class="profile-icon">
            <i class="fas fa-user"></i> {{-- Font Awesome --}}
        </div>
        <div class="profile-details">
            <h2>Profil Pengguna</h2>
            <p><strong>Nama:</strong> {{ auth()->user()->name ?? '-' }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email ?? '-' }}</p>
            {{-- Tambah kolom lain seperti Nomor HP, Alamat, dll --}}
        </div>
    </div>
</div>
@endsection
