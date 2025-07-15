<x-layouts.app :title="'Daftar Services'">
    <div class="container py-6">
        <h1 class="mb-4 text-2xl font-semibold">Daftar Services</h1>

        <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-4">
            Tambah Service Baru
        </a>

        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-700">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-800">
                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">ID</th>
                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">Nama Service</th>
                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">Deskripsi</th>
                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-right">Harga</th>
                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">Gambar</th>
                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">{{ $service->id }}</td>
                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">{{ $service->name }}</td>
                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">{{ Str::limit($service->description, 50) }}</td>
                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-right">
                            Rp {{ number_format($service->price, 0, ',', '.') }}
                        </td>
                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">
                            @if($service->image_url)
                                <img src="{{ Storage::url($service->image_url) }}" alt="{{ $service->name }}" class="h-12 mx-auto rounded-md object-cover" />

                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center space-x-2">
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus service ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500 dark:text-gray-400">
                            Data service belum tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
