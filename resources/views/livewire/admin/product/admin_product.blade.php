<x-layouts.app :title="'Manajemen Produk'">
    <style>
  /* Table styling */
  table {
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 0.5rem;
    overflow: hidden;
  }

  thead tr {
    background-color: #eff6ff; /* Tailwind blue-50 */
  }

  thead th {
    font-weight: 700;
    color: #1e40af; /* Tailwind blue-800 */
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 0.75rem 1.5rem;
    user-select: none;
  }

  tbody tr {
    transition: background-color 0.3s ease;
  }

  tbody tr:hover {
    background-color: #bfdbfe; /* Tailwind blue-200 */
  }

  tbody td {
    padding: 0.75rem 1.5rem;
    color: #1e3a8a; /* Tailwind blue-900 */
    vertical-align: middle;
  }

  tbody td.text-center {
    text-align: center;
  }

  /* Image styling */
  tbody img {
    border-radius: 0.375rem;
    border: 1px solid #bfdbfe;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  }

  /* Buttons */
  a.inline-block,
  button.inline-block {
    font-weight: 600;
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem;
    box-shadow: 0 2px 5px rgba(219, 39, 119, 0.3);
    transition:
      background-color 0.3s ease,
      box-shadow 0.3s ease,
      color 0.3s ease;
  }

  a.inline-block,
  button.inline-block {
    background-color: #f472b6; /* Tailwind pink-400 */
    color: #000000;
    border: none;
    cursor: pointer;
    display: inline-block;
  }

  a.inline-block:hover,
  button.inline-block:hover {
    background-color: #ec4899; /* Tailwind pink-500 */
    box-shadow: 0 4px 10px rgba(236, 72, 153, 0.6);
    color: #000000;
    text-decoration: none;
  }

  /* Confirm delete button cursor */
  button.inline-block:focus {
    outline: 2px solid #ec4899;
    outline-offset: 2px;
  }

  /* Responsive table */
  .overflow-x-auto {
    overflow-x: auto;
  }
</style>

    <div class="p-6 max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-blue-900">Daftar Produk</h1>

        <a href="{{ route('admin.products.create') }}"
           class="inline-block mb-6 px-6 py-3 bg-pink-400 text-black rounded-lg shadow-md
                  hover:bg-pink-500 transition duration-300 font-semibold">
            + Tambah Produk
        </a>

        <div class="overflow-x-auto rounded-lg shadow-md border border-blue-300">
            <table class="min-w-[900px] w-full divide-y divide-blue-300 bg-white text-left text-sm">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="px-6 py-3 font-semibold text-blue-700 uppercase tracking-wider" style="width: 40px;">#</th>
                        <th class="px-6 py-3 font-semibold text-blue-700 uppercase tracking-wider" style="width: 80px;">Gambar</th>
                        <th class="px-6 py-3 font-semibold text-blue-700 uppercase tracking-wider" style="width: 180px;">Nama</th>
                        <th class="px-6 py-3 font-semibold text-blue-700 uppercase tracking-wider" style="width: 140px;">Kategori</th>
                        <th class="px-6 py-3 font-semibold text-blue-700 uppercase tracking-wider max-w-xs" style="width: 300px;">Deskripsi</th>
                        <th class="px-6 py-3 font-semibold text-blue-700 uppercase tracking-wider" style="width: 120px;">Harga</th>
                        <th class="px-6 py-3 font-semibold text-blue-700 uppercase tracking-wider text-center" style="width: 110px;">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-blue-200">
                    @forelse ($products as $index => $product)
                        <tr class="hover:bg-blue-200 transition-colors duration-200">
                            <td class="px-6 py-4 font-semibold text-blue-900 text-center whitespace-nowrap">{{ $index + 1 }}</td>

                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name ?? 'Produk' }}"
                                         class="h-16 w-16 object-cover rounded-md border border-blue-200 shadow-sm mx-auto">
                                @else
                                    <span class="text-blue-400 italic text-sm">Tidak ada</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 max-w-[180px] font-semibold text-blue-800 truncate" title="{{ $product->name }}">
                                {{ $product->name }}
                            </td>

                            <td class="px-6 py-4 text-blue-600 whitespace-nowrap">{{ $product->category->name ?? '-' }}</td>

                            <td class="px-6 py-4 max-w-xs text-blue-600 truncate" title="{{ $product->description ?? '-' }}">
                                {{ $product->description ?? '-' }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-blue-900 whitespace-nowrap">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-center space-x-3">
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                   class="inline-block px-3 py-1 bg-pink-400 text-black rounded-md shadow hover:bg-pink-500 transition"
                                   title="Edit Produk">
                                    Edit
                                </a>

                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-block px-3 py-1 bg-pink-400 text-black rounded-md shadow hover:bg-pink-500 transition cursor-pointer"
                                            title="Hapus Produk">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-10 text-blue-500 italic text-lg">Belum ada produk tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
