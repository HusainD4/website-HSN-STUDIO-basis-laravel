<x-layouts.app :title="'Edit Paket Jasa Foto Studio'">
    <div class="max-w-xl mx-auto">
        <h1 class="mb-6 text-2xl font-semibold text-pink-600">Edit Paket Jasa Foto Studio</h1>

        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block mb-1 font-medium">Nama Paket</label>
                <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300" value="{{ old('name', $service->name) }}" required>
                @error('name') <small class="text-pink-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label for="description" class="block mb-1 font-medium">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300">{{ old('description', $service->description) }}</textarea>
                @error('description') <small class="text-pink-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label for="price" class="block mb-1 font-medium">Harga</label>
                <input type="number" name="price" id="price" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300" value="{{ old('price', $service->price) }}" required>
                @error('price') <small class="text-pink-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Gambar Saat Ini</label>
                @if($service->image_url)
                    <img src="{{ Storage::url($service->image_url) }}" class="h-32 rounded mb-2">
                @else
                    <span class="text-gray-500">Belum ada gambar</span>
                @endif
            </div>

            <div>
                <label for="image" class="block mb-1 font-medium">Ganti Gambar</label>
                <input type="file" name="image" id="image" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-300" accept="image/*">
                @error('image') <small class="text-pink-600">{{ $message }}</small> @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-pink-500 text-white py-2 rounded hover:bg-pink-600">Update</button>
                <a href="{{ route('admin.services.index') }}" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded hover:bg-gray-400 text-center">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.app>
