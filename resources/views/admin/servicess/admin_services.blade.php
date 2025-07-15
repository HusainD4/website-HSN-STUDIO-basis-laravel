<x-layouts.app :title="'services'">
    <style>
        body {
            background-color: #fdf6f9;
        }
        
        .service-container {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(255, 182, 193, 0.3);
            font-family: 'Segoe UI', sans-serif;
        }

        .service-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ff69b4;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #ffe4ec;
        }

        th, td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #f0cde3;
            vertical-align: middle;
        }

        th {
            font-size: 0.85rem;
            color: #ff4d94;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            color: #333;
            font-size: 0.95rem;
        }

        /* Styling gambar kecil */
        .service-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 12px;
        }

        .service-info {
            display: flex;
            align-items: center;
        }

        .service-description {
            font-size: 0.85rem;
            color: #666;
            margin-top: 4px;
        }

        .create-btn {
            background-color: #ff69b4;
            color: white;
            padding: 10px 18px;
            border-radius: 12px;
            font-weight: 600;
            transition: 0.2s ease;
            text-decoration: none;
        }

        .create-btn:hover {
            background-color: #e85a9e;
        }

        .action-btn {
            font-weight: 600;
            margin-right: 10px;
            text-decoration: underline;
            transition: color 0.2s;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .action-btn.edit {
            color: #3b82f6;
        }

        .action-btn.edit:hover {
            color: #1d4ed8;
        }

        .action-btn.delete {
            color: #ef4444;
        }

        .action-btn.delete:hover {
            color: #b91c1c;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination .active {
            font-weight: bold;
            color: #ff69b4;
        }
    </style>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 service-container">
            <h2 class="service-title">📸 Daftar Paket Jasa Foto Studio</h2>

            <div class="mb-4 text-right">
                <a href="{{ route('admin.services.create') }}" class="create-btn">➕ Tambah Service</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Nama Paket</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr>
                            <td>
                                <div class="service-info">
                                    @if($service->image_url)
                                        <img src="{{ asset('storage/' . $service->image_url) }}" alt="{{ $service->name }}" class="service-image" />
                                    @else
                                        <div class="service-image" style="background:#f0f0f0;display:flex;align-items:center;justify-content:center;color:#ccc;">No Image</div>
                                    @endif
                                    <div>
                                        {{ $service->name }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="service-description">{{ $service->description }}</div>
                            </td>
                            <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.services.edit', $service) }}" class="action-btn edit">Edit</a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500">Belum ada layanan ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4 pagination">
                {{ $services->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
