<x-layouts.app :title="__('Tambah Kategori')">
    <div class="p-6 max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold mb-4">Tambah Kategori Baru</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block font-medium">Nama Kategori</label>
                <input type="text" name="name" id="name" class="border p-2 w-full rounded" value="{{ old('name') }}" required>
            </div>

            <div>
                <label for="slug" class="block font-medium">Slug</label>
                <input type="text" name="slug" id="slug" class="border p-2 w-full rounded bg-gray-100 text-gray-500 cursor-not-allowed" disabled>
            </div>

            <div>
                <label for="brand_name" class="block font-medium">Brand Name (Opsional)</label>
                <input type="text" name="brand_name" id="brand_name" class="border p-2 w-full rounded" value="{{ old('brand_name') }}">
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Simpan
            </button>
        </form>
    </div>

    <script>
        document.getElementById('name').addEventListener('input', function () {
            const nameValue = this.value;
            const slugValue = nameValue
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '') // hilangkan karakter khusus
                .replace(/\s+/g, '-')         // ganti spasi dengan -
                .replace(/-+/g, '-');         // hindari multiple dash

            document.getElementById('slug').value = slugValue;
        });
    </script>
</x-layouts.app>
