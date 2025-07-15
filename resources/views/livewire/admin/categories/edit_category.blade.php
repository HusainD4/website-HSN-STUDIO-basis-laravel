<x-layouts.app :title="__('Edit Kategori')">
    <div class="p-6 max-w-xl mx-auto">
        <h2 class="text-2xl font-bold mb-6">Edit Kategori</h2>

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block font-medium">Nama Kategori</label>
                <input type="text" name="name" id="name"
                    class="border p-2 w-full rounded"
                    value="{{ old('name', $category->name) }}"
                    required>
            </div>

            <div>
                <label for="slug" class="block font-medium">Slug</label>
                <input type="text" name="slug" id="slug"
                    class="border p-2 w-full rounded"
                    value="{{ old('slug', $category->slug) }}"
                    required>
            </div>

            <div>
                <label for="brand_name" class="block font-medium">Brand Name (Opsional)</label>
                <input type="text" name="brand_name" id="brand_name"
                    class="border p-2 w-full rounded"
                    value="{{ old('brand_name', $category->brand_name) }}">
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.categories.index') }}"
                   class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2">Batal</a>
                <button type="submit"
                        class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</x-layouts.app>
