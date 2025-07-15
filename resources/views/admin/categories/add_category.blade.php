<x-layouts.app :title="'Tambah Kategori Baru'">
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
            border: 2px solid #fbcfe8;
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
        }

        input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #c7d2fe;
            transition: all 0.3s ease;
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

        .alert {
            background-color: #ffe4e6;
            color: #9d174d;
            border-left: 4px solid #f472b6;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .alert ul {
            padding-left: 20px;
            margin-top: 10px;
        }
    </style>

    <div class="max-w-2xl mx-auto">
        <div class="soft-container">
            <h2>✨ Tambah Kategori Manis ✨</h2>

            @if ($errors->any())
                <div class="alert">
                    <p class="font-bold">Oopsie! Ada yang salah nih:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name">Nama Kategori</label>
                    <input type="text" name="name" id="name"
                           value="{{ old('name') }}"
                           required placeholder="cth: Stiker Lucu">
                </div>

                <div>
                    <label for="slug">Slug (Otomatis)</label>
                    <input type="text" name="slug" id="slug"
                           value="{{ old('slug') }}"
                           readonly style="background-color: #f0f9ff; color: #64748b; cursor: not-allowed;">
                </div>

                <div>
                    <label for="brand_name">Brand Name (Kalau ada yaa)</label>
                    <input type="text" name="brand_name" id="brand_name"
                           value="{{ old('brand_name') }}"
                           placeholder="cth: HSN Studio">
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="btn-submit">
                        💖 Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')         
                .replace(/[^\w\-]+/g, '')     
                .replace(/\-\-+/g, '-')       
                .replace(/^-+/, '')           
                .replace(/-+$/, '');          
        }

        document.getElementById('name').addEventListener('input', function () {
            const slugInput = document.getElementById('slug');
            slugInput.value = slugify(this.value);
        });

        window.addEventListener('DOMContentLoaded', () => {
            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');
            if (nameInput.value) {
                slugInput.value = slugify(nameInput.value);
            }
        });
    </script>
</x-layouts.app>
