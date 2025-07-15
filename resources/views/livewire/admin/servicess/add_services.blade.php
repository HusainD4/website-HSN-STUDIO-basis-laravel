<x-layouts.app :title="'Tambah Paket Jasa Foto Studio'">
    <div class="max-w-xl mx-auto">
        <h1 class="mb-6 text-2xl font-semibold text-pink-600">Tambah Paket Jasa Foto Studio</h1>

        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block mb-1 font-medium">Nama Paket</label>
                <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300" value="{{ old('name') }}" required>
                @error('name') <small class="text-pink-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label for="description" class="block mb-1 font-medium">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300">{{ old('description') }}</textarea>
                @error('description') <small class="text-pink-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label for="price" class="block mb-1 font-medium">Harga</label>
                <input type="number" name="price" id="price" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300" value="{{ old('price') }}" required>
                @error('price') <small class="text-pink-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label for="image" class="block mb-1 font-medium">Gambar Paket</label>
                <input type="file" name="image" id="image" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300" accept="image/*">
                @error('image') <small class="text-pink-600">{{ $message }}</small> @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-pink-500 text-white py-2 rounded hover:bg-pink-600">Simpan</button>
                <a href="{{ route('admin.services.index') }}" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded hover:bg-gray-400 text-center">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.app>
