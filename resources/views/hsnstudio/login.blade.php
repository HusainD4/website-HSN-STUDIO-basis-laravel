<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - HSN Studio</title>

    {{-- CSS untuk tema sekarang ada di dalam file ini --}}
    <style>
        /* Reset dan Font Dasar */
        :root {
            --color-blue-500: #3B82F6;
            --color-blue-600: #2563EB;
            --color-pink-500: #EC4899;
            --color-pink-600: #DB2777;
            --color-gray-600: #4B5563;
            --color-gray-700: #374151;
            --color-gray-800: #1F2937;
            --color-red-100: #FEE2E2;
            --color-red-700: #B91C1C;
            
            /* -- WARNA BARU UNTUK BG LEBIH JELAS -- */
            --grad-1: #ff758c;
            --grad-2: #ff7eb3;
            --grad-3: #8e44ad;
            --grad-4: #74b9ff;
        }

        /* Latar Belakang Gradasi dan Kontainer Utama dengan Animasi */
        body {
            margin: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
            
            /* -- PERUBAHAN BG ANIMASI DENGAN WARNA BARU -- */
            background: linear-gradient(-45deg, var(--grad-1), var(--grad-2), var(--grad-3), var(--grad-4));
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;

            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        /* Panel Login Utama */
        .login-card {
            width: 100%;
            max-width: 28rem; /* 448px */
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem; /* Dibuat lebih bulat */
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            padding: 2.5rem; /* Padding ditambah */
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Header Teks */
        .card-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .card-header h2 {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--color-gray-800);
            margin: 0;
        }
        .card-header p {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: var(--color-gray-600);
        }

        /* Styling Form */
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--color-gray-700);
        }

        /* -- PERUBAHAN INPUT LEBIH LUCU -- */
        .form-input {
            display: block;
            width: 100%;
            padding: 0.9rem 1rem; /* Dibuat lebih tebal */
            border: 1px solid #D1D5DB;
            border-radius: 0.75rem; /* Dibuat lebih bulat */
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            transition: box-shadow 0.2s ease-in-out, border-color 0.2s ease-in-out;
            box-sizing: border-box;
            background-color: #fff;
        }

        /* -- PERUBAHAN ANIMASI INPUT ON FOCUS -- */
        .form-input:focus {
            outline: none;
            border-color: var(--color-pink-500); /* Border pink saat aktif */
            box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.3); /* Efek glow pink */
            animation: inputWiggle 0.4s ease-in-out; /* Animasi goyang */
        }
        .form-input::placeholder {
            color: #9CA3AF;
        }

        /* Checkbox "Ingat Saya" */
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .remember-me input[type="checkbox"] {
            height: 1.1rem;
            width: 1.1rem;
            border-radius: 0.25rem;
            border-color: #D1D5DB;
            color: var(--color-pink-500); /* Checkbox jadi pink */
            cursor: pointer;
        }
        .remember-me label {
            margin-left: 0.5rem;
            font-size: 0.875rem;
            cursor: pointer;
        }

        /* Tombol Submit */
        .submit-button {
            width: 100%;
            padding: 0.85rem 1rem;
            border: none;
            border-radius: 0.75rem;
            background-color: var(--color-blue-500);
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
        }
        .submit-button:hover {
            background-color: var(--color-blue-600);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(59, 130, 246, 0.3);
        }

        /* Link Bawah */
        .bottom-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: var(--color-gray-600);
        }
        .bottom-link a {
            font-weight: 500;
            color: var(--color-pink-500);
            text-decoration: none;
        }
        .bottom-link a:hover {
            color: var(--color-pink-600);
            text-decoration: underline;
        }

        /* Notifikasi Error */
        .alert-error {
            padding: 1rem;
            margin-bottom: 1.5rem;
            background-color: var(--color-red-100);
            color: var(--color-red-700);
            border-radius: 0.5rem;
            text-align: center;
            font-size: 0.875rem;
        }
        .field-error {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: var(--color-red-700);
        }
        
        /* KEYFRAME UNTUK ANIMASI GRADASI */
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* -- KEYFRAME BARU UNTUK ANIMASI INPUT -- */
        @keyframes inputWiggle {
            0% { transform: translateX(0); }
            25% { transform: translateX(-3px) rotate(-1deg); }
            50% { transform: translateX(3px) rotate(1deg); }
            75% { transform: translateX(-3px) rotate(-1deg); }
            100% { transform: translateX(0); }
        }

    </style>
</head>
<body>
    <div class="login-card">
        <div class="card-header">
            <h2>Masuk ke HSN Studio 👋</h2>
            <p>Selamat datang kembali!</p>
        </div>

        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
        @csrf
    {{-- Input email, password, dan tombol submit --}}

            <div class="form-group">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-input" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                @error('email') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" name="password" id="password" class="form-input" placeholder="Masukkan kata sandi" required>
                @error('password') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="remember-me">
                <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Ingat Saya</label>
            </div>

            <button type="submit" class="submit-button">Masuk</button>
        </form>

        <div class="bottom-link">
    Belum punya akun?
    <a href="{{ route('register') }}">Daftar di sini</a>
</div>
    </div>
</body>
</html>