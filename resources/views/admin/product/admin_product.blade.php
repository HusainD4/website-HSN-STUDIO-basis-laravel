<x-layouts.app :title="'Manajemen Produk'">
<style>
  body {
    background: linear-gradient(135deg, #a5d8ff, #ffffff, #ffc8dd);
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
  }

  .p-6 {
    background-color: #ffffff;
    border-radius: 1.25rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
    border: 1px solid #bfdbfe;
    padding: 2rem;
  }

  h1 {
    color: #ec4899;
    text-shadow: 1px 1px 0 #fde7f3;
  }

  .btn-action {
    font-weight: 600;
    padding: 0.4rem 0.8rem;
    border-radius: 0.5rem;
    background-color: #fbcfe8;
    color: #6b21a8;
    box-shadow: 0 2px 5px rgba(219, 39, 119, 0.25);
    transition: all 0.3s ease-in-out;
    border: none;
    font-size: 0.85rem;
    cursor: pointer;
  }

  .btn-action:hover {
    background-color: #f9a8d4;
    color: #4c1d95;
    box-shadow: 0 4px 12px rgba(219, 39, 119, 0.4);
    text-decoration: none;
  }

  table {
    width: 100%;
    border-radius: 0.75rem;
    overflow: hidden;
    background-color: #ffffff;
    border-collapse: collapse;
  }

  thead tr {
    background-color: #dbeafe;
  }

  thead th {
    font-weight: 700;
    color: #1e3a8a;
    text-transform: uppercase;
    padding: 0.75rem 1rem;
    text-align: left;
    white-space: nowrap;
  }

  tbody td {
    padding: 0.75rem 1rem;
    color: #1e3a8a;
    vertical-align: middle;
    white-space: nowrap;
  }

  tbody tr:hover {
    background-color: #f0f9ff;
  }

  tbody img {
    width: 64px;
    height: 64px;
    object-fit: cover;
    border-radius: 0.5rem;
    border: 1px solid #a5d8ff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
    cursor: pointer;
    transition: transform 0.2s ease-in-out;
  }

  tbody img:hover {
    transform: scale(1.05);
  }

  .btn-action.bg-green-200 {
    background-color: #bbf7d0;
    color: #065f46;
    border: 1px solid #86efac;
  }

  .btn-action.bg-green-200:hover {
    background-color: #86efac;
    color: #064e3b;
  }

  .btn-action.bg-red-200 {
    background-color: #fecaca;
    color: #991b1b;
    border: 1px solid #f87171;
  }

  .btn-action.bg-red-200:hover {
    background-color: #f87171;
    color: #7f1d1d;
  }

  .modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.75);
  }

  .modal-content {
    margin: 5% auto;
    display: block;
    max-width: 80%;
    border-radius: 1rem;
    box-shadow: 0 0 25px rgba(255, 255, 255, 0.3);
  }

  .modal-close {
    position: absolute;
    top: 20px;
    right: 35px;
    color: white;
    font-size: 2rem;
    font-weight: bold;
    cursor: pointer;
  }

  .pagination {
    margin-top: 1.5rem;
    display: flex;
    justify-content: center;
  }

  .pagination .page-link {
    background-color: #fbcfe8;
    color: #6b21a8;
    border-radius: 0.375rem;
    margin: 0 0.25rem;
    padding: 0.4rem 0.75rem;
    transition: all 0.3s ease;
    font-weight: 500;
    border: none;
  }

  .pagination .page-link:hover {
    background-color: #f9a8d4;
    color: #4c1d95;
  }

  .pagination .active .page-link {
    background-color: #ec4899;
    color: #ffffff;
  }

  /* Responsive tweaks */
  @media (max-width: 768px) {
    table {
      font-size: 0.85rem;
    }

    .btn-action {
      padding: 0.35rem 0.65rem;
      font-size: 0.8rem;
    }
  }
</style>


  <div class="p-6 max-w-7xl mx-auto">
    {{-- Flash Message --}}
    @if (session('success'))
      <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow">
        {{ session('success') }}
      </div>
    @endif

    {{-- Header --}}
    <!-- <div class="flex items-center justify-between mb-6">
      <h1 class="text-3xl font-extrabold">📦 Daftar Produk</h1>
      <a href="{{ route('admin.products.create') }}" class="btn-action">+ Tambah Produk</a>
    </div> -->
    <div class="flex justify-between items-center mb-4">
        <h2>📁 Manajemen Kategori</h2>
        <a href="{{ route('admin.products.create') }}" class="btn-action">+ Tambah Produk</a>
    </div>
    {{-- Tabel Produk --}}
    <div class="overflow-x-auto rounded-xl shadow border border-pink-200">
      <table class="min-w-[1000px] text-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $index => $product)
            <tr>
              <td class="text-center">{{ $index + 1 }}</td>
              <td class="text-center">
                @if($product->image)
                  <img src="{{ asset('storage/' . $product->image) }}"
                       alt="{{ $product->name }}"
                       onclick="showImageModal('{{ asset('storage/' . $product->image) }}')">
                @else
                  <span class="text-blue-400 italic text-sm">Tidak ada</span>
                @endif
              </td>
              <td class="font-semibold text-blue-800 truncate" title="{{ $product->name }}">
                {{ $product->name }}
              </td>
              <td class="text-blue-600">{{ $product->category->name ?? '-' }}</td>
              <td class="text-blue-600 truncate" title="{{ $product->description ?? '-' }}">
                {{ Str::limit($product->description, 50) }}
              </td>
              <td class="font-semibold text-blue-900">
                Rp {{ number_format($product->price, 0, ',', '.') }}
              </td>
              <td class="text-center">
                <form action="{{ route('admin.products.toggle', $product->id) }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <button type="submit"
                          class="btn-action {{ $product->is_active ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                    {{ $product->is_active ? '✅ Aktif' : '⛔ Nonaktif' }}
                  </button>
                </form>
              </td>
              <td class="text-center space-x-2">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-action">✏️ Edit</a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                      class="inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-action">🗑️ Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center py-8 text-blue-500 italic text-lg">
                Belum ada produk tersedia. 🌸
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="pagination">
      {{ $products->links() }}
    </div>
  </div>

  {{-- Modal Image Viewer --}}
  <div id="imageModal" class="modal" onclick="closeModal()">
    <span class="modal-close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
  </div>

  <script>
    function showImageModal(src) {
      document.getElementById('imageModal').style.display = 'block';
      document.getElementById('modalImage').src = src;
    }

    function closeModal() {
      document.getElementById('imageModal').style.display = 'none';
    }
  </script>
</x-layouts.app>
