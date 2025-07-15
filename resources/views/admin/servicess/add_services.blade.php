<x-layouts.app :title="'Tambah Paket Jasa Foto Studio'">
    <style>
        .cute-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff0f6;
            border-radius: 20px;
            box-shadow: 0 6px 20px rgba(255, 182, 193, 0.3);
            font-family: 'Comic Sans MS', 'Segoe UI', cursive, sans-serif;
        }

        .cute-container h2 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #ff69b4;
            margin-bottom: 24px;
            text-align: center;
        }

        .cute-container label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.95rem;
            font-weight: 600;
            color: #4c51bf;
        }

        .cute-container input[type="text"],
        .cute-container input[type="number"],
        .cute-container textarea,
        .cute-container input[type="file"] {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #b2f5ea;
            border-radius: 12px;
            font-size: 1rem;
            background-color: #ffffff;
            color: #2d3748;
            box-shadow: 0 2px 4px rgba(173, 216, 230, 0.2);
            transition: border 0.3s, box-shadow 0.3s;
            margin-bottom: 10px;
        }

        .cute-container input:focus,
        .cute-container textarea:focus {
            outline: none;
            border-color: #ff90b3;
            box-shadow: 0 0 0 3px rgba(255, 182, 193, 0.3);
        }

        .cute-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .cute-btn {
            display: inline-block;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 12px;
            font-size: 1rem;
            transition: 0.3s all ease-in-out;
            text-align: center;
        }

        .cute-btn.cancel {
            background-color: #e0e0e0;
            color: #4a5568;
        }

        .cute-btn.cancel:hover {
            background-color: #cbd5e0;
        }

        .cute-btn.update {
            background-color: #f687b3;
            color: white;
        }

        .cute-btn.update:hover {
            background-color: #ed64a6;
        }

        .error-text {
            font-size: 0.85rem;
            color: #e53e3e;
        }
    </style>

    <div class="cute-container">
        <h2>📸 Tambah Paket Jasa Foto Studio</h2>

        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="name">Nama Paket</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                @error('name') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
                @error('description') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="price">Harga</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" required>
                @error('price') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="image">Gambar Paket</label>
                <input type="file" name="image" id="image" accept="image/*">
                @error('image') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="cute-actions">
                <a href="{{ route('admin.services.index') }}" class="cute-btn cancel">Batal</a>
                <button type="submit" class="cute-btn update">Simpan</button>
            </div>
        </form>
    </div>
</x-layouts.app>
