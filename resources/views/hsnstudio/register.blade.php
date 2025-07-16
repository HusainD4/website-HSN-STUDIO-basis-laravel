<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - HSN Studio</title>

    {{-- CSS Tema Lucu dan Animasi --}}
    <style>
        :root {
            --color-blue-500: #3B82F6;
            --color-blue-600: #2563EB;
            --color-pink-500: #EC4899;
            --color-pink-600: #DB2777;
            --color-gray-600: #4B5563;
            --color-gray-700: #374151;
            --color-gray-800: #1F2937;
            --color-red-700: #B91C1C;

            --grad-1: #ff758c;
            --grad-2: #ff7eb3;
            --grad-3: #8e44ad;
            --grad-4: #74b9ff;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(-45deg, var(--grad-1), var(--grad-2), var(--grad-3), var(--grad-4));
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;

            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .auth-card {
            width: 100%;
            max-width: 28rem;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

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

        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--color-gray-700);
        }

        .form-input {
            display: block;
            width: 100%;
            padding: 0.9rem 1rem;
            border: 1px solid #D1D5DB;
            border-radius: 0.75rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: box-shadow 0.2s ease, border-color 0.2s ease;
            background-color: #fff;
            box-sizing: border-box;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--color-pink-500);
            box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.3);
            animation: inputWiggle 0.4s ease-in-out;
        }

        .form-input::placeholder {
            color: #9CA3AF;
        }

        .submit-button {
            width: 100%;
            padding: 0.85rem 1rem;
            margin-top: 1rem;
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

        .field-error {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: var(--color-red-700);
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

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
    <div class="auth-card">
        <div class="card-header">
            <h2>Buat Akun Barumu ✨</h2>
            <p>Hanya butuh beberapa detik untuk bergabung.</p>
        </div>

        <form method="POST" action="{{ route('user.register.post') }}">


            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input id="name" type="text" name="name" class="form-input" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Masukkan nama lengkapmu">
                @error('name')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" class="form-input" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@email.com">
                @error('email')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" class="form-input" required autocomplete="new-password" placeholder="Buat password rahasia">
                @error('password')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-input" required autocomplete="new-password" placeholder="Ketik ulang password">
                @error('password_confirmation')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="submit-button">
                Buat Akun
            </button>
        </form>

        <div class="bottom-link">
            Sudah punya akun?
            <a href="{{ route('user.login') }}">Login di sini</a>
        </div>
    </div>
</body>
</html>
