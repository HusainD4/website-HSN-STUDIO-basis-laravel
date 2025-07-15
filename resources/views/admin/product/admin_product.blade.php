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
    }

    .btn-action:hover {
      background-color: #f9a8d4;
      color: #4c1d95;
      box-shadow: 0 4px 12px rgba(219, 39, 119, 0.4);
      text-decoration: none;
    }

    table {
      border-radius: 0.75rem;
      overflow: hidden;
      background-color: #ffffff;
    }

    thead tr {
      background-color: #dbeafe;
    }

    thead th {
      font-weight: 700;
      color: #1e3a8a;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      padding: 0.75rem 1.25rem;
    }

    tbody tr:hover {
      background-color: #e0f2fe;
    }

    tbody td {
      padding: 0.75rem 1.25rem;
      color: #1e3a8a;
      vertical-align: middle;
    }

    .text-center {
      text-align: center;
    }

    tbody img {
      width: 64px;
      height: 64px;
      object-fit: cover;
      border-radius: 0.5rem;
      border: 1px solid #a5d8ff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
      cursor: pointer;
      transition: 0.2s ease-in-out;
    }

    tbody img:hover {
      transform: scale(1.05);
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 9999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.7);
    }

    .modal-content {
      margin: 5% auto;
      display: block;
      max-width: 80%;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
    }

    .modal-content:hover {
      box-shadow: 0 0 30px rgba(255, 255, 255, 0.4);
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
  </style>

  <div class="p-6 max-w-7xl mx-auto">
    <h1 class="text-3xl font-extrabold mb-6">Daftar Produk</h1>

    <a href="{{ route('admin.products.create') }}" class="btn-action mb-6 inline-block">+ Tambah Produk</a>

    <div class="overflow-x-auto rounded-xl shadow-md border border-pink-200">
      <table class="min-w-[900px] w-full divide-y divide-blue-200 text-left text-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Harga</th>
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
                       class="mx-auto"
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
                {{ $product->description ?? '-' }}
              </td>
              <td class="font-semibold text-blue-900">
                Rp {{ number_format($product->price, 0, ',', '.') }}
              </td>
              <td class="text-center space-x-2">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-action">✏️ Edit</a>
                <form action="{{ route('admin.products.destroy', $product->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                      class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-action">🗑️ Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center py-10 text-blue-500 italic text-lg">
                Belum ada produk tersedia. 🌸
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Modal Viewer --}}
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
