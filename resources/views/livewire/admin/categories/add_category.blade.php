<div class="max-w-2xl mx-auto mt-10 bg-white shadow-md rounded-xl p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">🗂️ Tambah Kategori Baru</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
            <input type="text" name="name" id="name"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                value="{{ old('name') }}" required>
        </div>

        <div>
            <label for="slug" class="block text-sm font-medium text-gray-700">Slug (Otomatis)</label>
            <input type="text" name="slug" id="slug"
                class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-500 cursor-not-allowed"
                disabled>
        </div>

        <div>
            <label for="brand_name" class="block text-sm font-medium text-gray-700">Brand Name (Opsional)</label>
            <input type="text" name="brand_name" id="brand_name"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm"
                value="{{ old('brand_name') }}">
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center px-5 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all">
                💾 Simpan
            </button>
        </div>
    </form>
</div>
