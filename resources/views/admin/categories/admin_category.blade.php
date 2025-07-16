<x-layouts.app :title="'Manajemen Category'">
    <style>
        body {
            background: linear-gradient(135deg, #a5d8ff, #ffffff, #ffc8dd);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        .soft-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
            padding: 32px;
            margin-top: 40px;
        }

        .soft-container h2 {
            font-size: 1.5rem;
            color: #3b0764;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th {
            background-color: #f0f4f8;
            color: #334155;
            padding: 12px;
            text-align: left;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            color: #475569;
        }

        .btn-create {
            background: linear-gradient(to right, #60a5fa, #f472b6);
            color: white;
            padding: 10px 16px;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.2s ease-in-out;
        }

        .btn-create:hover {
            opacity: 0.9;
        }

        .btn-action {
            display: inline-block;
            padding: 6px 12px;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 8px;
            transition: 0.2s ease-in-out;
            text-decoration: none;
        }

        .btn-edit {
            background-color: #dbeafe;
            color: #2563eb;
        }

        .btn-edit:hover {
            background-color: #bfdbfe;
        }

        .btn-delete {
            background-color: #fee2e2;
            color: #dc2626;
            margin-left: 8px;
        }

        .btn-delete:hover {
            background-color: #fecaca;
        }

        .pagination {
            margin-top: 20px;
        }
    </style>

    <div class="py-12">
        <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
            <div class="soft-container">
                <div class="flex justify-between items-center mb-4">
                    <h2>📁 Manajemen Kategori</h2>
                    <a href="{{ route('admin.categories.create') }}" class="btn-create">+ Tambah Kategori</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Brand Name</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr wire:key="{{ $category->id }}">
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->brand_name }}</td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn-action btn-edit">✏️ Edit</a>
                                    <button wire:click="delete({{ $category->id }})" class="btn-action btn-delete">🗑️ Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500">Belum ada kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

