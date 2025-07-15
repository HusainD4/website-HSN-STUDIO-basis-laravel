    <x-layouts.app :title="__('Kategori - Admin')">
        <div class="p-6 max-w-5xl mx-auto">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-bold">Daftar Kategori</h2>
                <a href="{{ route('admin.categories.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Tambah Kategori</a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($categories->count())
                <table class="w-full border border-gray-300 text-sm">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border text-left">Nama</th>
                            <th class="p-2 border text-left">Slug</th>
                            <th class="p-2 border text-left">Brand</th>
                            <th class="p-2 border text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-50">
                                <td class="p-2 border">{{ $category->name }}</td>
                                <td class="p-2 border">{{ $category->slug }}</td>
                                <td class="p-2 border">{{ $category->brand_name ?? '-' }}</td>
                                <td class="p-2 border space-x-2">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="text-blue-600 hover:underline">Edit</a>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                        method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $categories->links() }} {{-- pagination --}}
                </div>
            @else
                <p class="text-gray-600 mt-4">Belum ada kategori.</p>
            @endif
        </div>
    </x-layouts.app>
