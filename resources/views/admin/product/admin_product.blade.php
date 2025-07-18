<x-layouts.app :title="'Manajemen Produk'">
    <style>
        body {
            background: linear-gradient(to right, #a5d8ff, #ffffff, #ffc8dd);
            font-family: 'Inter', sans-serif;
        }

        .soft-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
            padding: 32px;
            margin-top: 40px;
        }

        .soft-container h2{
            font-size: 1.8rem;
            font-weight: 700;
            color: #3b0764;
            margin-bottom: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        th {
            background-color: #f0f4f8;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .btn-create {
            background: linear-gradient(to right, #60a5fa, #f472b6);
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-action {
            padding: 6px 12px;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-edit {
            background-color: #dbeafe;
            color: #2563eb;
        }

        .btn-delete {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .toggle-switch {
            position: relative;
            width: 42px;
            height: 24px;
        }

        .toggle-switch input {
            display: none;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            background-color: #ccc;
            border-radius: 24px;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            transition: 0.4s;
        }

        .slider:before {
            content: "";
            position: absolute;
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            border-radius: 50%;
            transition: 0.4s;
        }

        input:checked + .slider {
            background-color: #4ade80;
        }

        input:checked + .slider:before {
            transform: translateX(18px);
        }

        .pagination {
            margin-top: 20px;
        }
    </style>
    
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="soft-container">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-center fw-bold mb-4">📦 Manajemen Produk</h2>
                    <a href="{{ route('admin.products.create') }}" class="btn-create">+ Tambah Produk</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>On/Off</th> <!-- Sudah diganti -->
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar" width="60">
                                    @else
                                        <span class="text-gray-400 italic">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td class="font-semibold text-blue-800">{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? '-' }}</td>
                                <td>{{ Str::limit($product->description, 50) }}</td>
                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>
                                    {{ $product->hub_product_id ? '✅ Sinkron' : '❌ Tidak Sinkron' }}
                                </td>
                                <td>
                                    <form id="sync-product-{{ $product->id }}" action="{{ route('admin.products.sync', $product->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="is_active" value="@if($product->hub_product_id) 1 @else 0 @endif">
                                        @if($product->hub_product_id)
                                            <flux:switch checked onchange="document.getElementById('sync-product-{{ $product->id }}').submit()" />
                                        @else
                                            <flux:switch onchange="document.getElementById('sync-product-{{ $product->id }}').submit()" />
                                        @endif
                                    </form>
                                </td>
                                <td class="space-x-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn-action btn-edit">✏️ Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">🗑️ Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-gray-500">Belum ada produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
