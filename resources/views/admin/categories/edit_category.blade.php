<x-layouts.app :title="'Edit Kategori'">
    <style>
        body {
            background: linear-gradient(135deg, #a5d8ff, #ffffff, #ffc8dd);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        .soft-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
            padding: 32px;
            margin-top: 40px;
            border: 2px solid #f9a8d4;
            max-width: 720px;
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #ec4899;
            text-align: center;
            margin-bottom: 24px;
        }

        label {
            color: #be185d;
            font-weight: 500;
            display: block;
            margin-bottom: 0.5rem;
        }

        input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #c7d2fe;
            background-color: #f9fafb;
            transition: all 0.3s ease;
            margin-bottom: 1.25rem;
        }

        input:focus {
            border-color: #f472b6;
            box-shadow: 0 0 0 3px rgba(244, 114, 182, 0.3);
            outline: none;
        }

        .btn-submit {
            background: linear-gradient(to right, #60a5fa, #f472b6);
            color: white;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 9999px;
            transition: 0.2s ease-in-out;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .btn-submit:hover {
            opacity: 0.9;
        }

        .btn-cancel {
            background-color: #f3f4f6;
            color: #4b5563;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 9999px;
            transition: 0.2s ease-in-out;
        }

        .btn-cancel:hover {
            background-color: #e5e7eb;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1rem;
        }
    </style>

    <div class="soft-container">
        <h2>🛠️ Edit Kategori</h2>

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="name">Nama Kategori</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $category->name) }}" required>
            </div>

            <div>
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug"
                       value="{{ old('slug', $category->slug) }}" required>
            </div>

            <div>
                <label for="brand_name">Brand Name (Opsional)</label>
                <input type="text" name="brand_name" id="brand_name"
                       value="{{ old('brand_name', $category->brand_name) }}">
            </div>

            <div class="action-buttons">
                <a href="{{ route('admin.categories.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">💾 Update</button>
            </div>
        </form>
    </div>
</x-layouts.app>
