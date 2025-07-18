<x-layouts.app :title="'Manajemen Jasa'">
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
      vertical-align: middle;
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

    .service-info {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .service-image {
      width: 60px;
      height: 60px;
      border-radius: 8px;
      object-fit: cover;
      background-color: #f0f0f0;
      border: 1px solid #ddd;
    }

    .service-description {
      max-width: 300px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      color: #475569;
    }
  </style>

  <div class="py-12">
    <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
      <div class="soft-container">
        <div class="flex justify-between items-center mb-4">
          <h2>📁 Manajemen Jasa</h2>
          <a href="{{ route('admin.services.create') }}" class="btn-create">➕ Tambah Service</a>
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
                      <img src="{{ asset('storage/' . $service->image_url) }}" alt="{{ $service->name }}" class="service-image">
                    @else
                      <div class="service-image" style="display:flex;align-items:center;justify-content:center;color:#ccc;">No Image</div>
                    @endif
                    <span>{{ $service->name }}</span>
                  </div>
                </td>
                <td>
                  <div class="service-description">{{ $service->description }}</div>
                </td>
                <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                <td>
                  <a href="{{ route('admin.services.edit', $service) }}" class="btn-action btn-edit">✏️ Edit</a>
                  <form action="{{ route('admin.services.destroy', $service) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</button>
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

        <div class="pagination">
          {{ $services->links() }}
        </div>
      </div>
    </div>
  </div>
</x-layouts.app>
