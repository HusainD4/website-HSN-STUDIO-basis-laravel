<x-layouts.app :title="'Kelola Paket Jasa Foto Studio'">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-pink-600">Kelola Paket Jasa Foto Studio</h2>
        <a href="{{ route('admin.services.create') }}" class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600">+ Tambah Paket</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($services as $service)
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
                <img src="{{ Storage::url($service->image_url) }}" alt="{{ $service->name }}" class="rounded-md mb-4 h-40 w-full object-cover">
                <h3 class="text-lg font-bold mb-2 text-pink-500">{{ $service->name }}</h3>
                <p>{{ Str::limit($service->description, 60) }}</p>
                <p class="font-semibold text-blue-600 mt-2">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('admin.services.edit', $service->id) }}" class="flex-1 bg-blue-400 text-white py-2 rounded hover:bg-blue-500 text-center">Edit</a>
                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus paket ini?');" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-pink-400 text-white py-2 rounded hover:bg-pink-500">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach

        @if($services->isEmpty())
            <p class="text-gray-500">Belum ada paket jasa yang ditambahkan.</p>
        @endif
    </div>
</x-layouts.app>
