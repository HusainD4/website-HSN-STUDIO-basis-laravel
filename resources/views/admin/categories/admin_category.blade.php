<x-layouts.app :title="'Manajemen Kategori'">
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
      font-size: 0.9rem;
      color: #1e293b;
    }

    td {
      color: #334155;
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

    .btn-create:hover {
      opacity: 0.9;
    }

    .btn-action {
      padding: 6px 12px;
      font-size: 0.85rem;
      font-weight: 600;
      border-radius: 6px;
      text-decoration: none;
      margin-right: 4px;
      cursor: pointer;
      border: none;
    }

    .btn-edit {
      background-color: #dbeafe;
      color: #2563eb;
    }

    .btn-delete {
      background-color: #fee2e2;
      color: #dc2626;
    }

    .pagination {
      margin-top: 20px;
      text-align: center;
    }

    .switch {
      transform: scale(1.1);
      cursor: pointer;
    }

    .text-center {
      text-align: center;
    }

    .text-gray-500 {
      color: #6b7280;
    }
  </style>

  <div class="py-12">
    <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
      <div class="soft-container">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-bold text-pink-700">📁 Manajemen Kategori</h2>
          <a href="{{ route('admin.categories.create') }}" class="btn-create">+ Tambah Kategori</a>
        </div>

        <table>
          <thead>
            <tr>
              <th>Nama</th>
              <th>Slug</th>
              <th>Brand</th>
              <th>Aksi</th>
              <th>Status Sinkron</th>
              <th>Aktif</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($categories as $category)
              <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->brand_name }}</td>
                <td>
                  <a href="{{ route('admin.categories.edit', $category) }}" class="btn-action btn-edit">✏️ Edit</a>
                  <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action btn-delete">🗑️ Hapus</button>
                  </form>
                </td>
                <td>
                  {{ $category->hub_category_id ? '✅ Tersinkron' : '❌ Belum Sinkron' }}
                </td>
                <td class="text-center">
                  <form id="sync-category-{{ $category->id }}" action="{{ route('admin.categories.sync', $category->id) }}" method="POST">
                    @csrf
                    {{-- 
                      Saat checkbox dicentang, kirim is_active=1
                      Saat tidak dicentang, kirim is_active=0
                      Jadi value checkbox sesuai status aktif
                    --}}
                    <input type="hidden" name="is_active" id="is_active_{{ $category->id }}" value="{{ $category->hub_category_id ? 1 : 0 }}">
                    <input 
                      type="checkbox" 
                      class="switch" 
                      {{ $category->hub_category_id ? 'checked' : '' }} 
                      onchange="document.getElementById('is_active_{{ $category->id }}').value = this.checked ? 1 : 0; this.form.submit()"
                      aria-label="Aktifkan Kategori {{ $category->name }}"
                    >
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center text-gray-500">Belum ada kategori.</td>
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
