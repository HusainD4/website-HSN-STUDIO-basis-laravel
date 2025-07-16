<x-layouts.app :title="'Kritik & Saran'">
  <style>
    body {
      background: linear-gradient(135deg, #a5d8ff, #ffffff, #ffc8dd);
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
    }

    .feedback-container {
      max-width: 80rem;
      margin: 3rem auto;
      background: #fff;
      padding: 2rem 2.5rem;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
    }

    .feedback-container h1 {
      font-size: 1.8rem;
      font-weight: 700;
      color: #3b0764;
      margin-bottom: 1.5rem;
    }

    .success-alert {
      background-color: #dcfce7;
      color: #15803d;
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-weight: 500;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    th {
      background-color: #f0f4f8;
      color: #334155;
      padding: 12px;
      text-align: left;
      text-transform: uppercase;
      font-size: 0.85rem;
    }

    td {
      padding: 12px;
      border-bottom: 1px solid #e2e8f0;
      color: #475569;
      vertical-align: top;
    }

    .btn-link {
      background-color: #e0f2fe;
      color: #0284c7;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 0.85rem;
      font-weight: 600;
      text-decoration: none;
      margin-right: 8px;
      transition: 0.2s ease;
    }

    .btn-link:hover {
      background-color: #bae6fd;
    }

    .btn-delete {
      background-color: #fee2e2;
      color: #dc2626;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 0.85rem;
      font-weight: 600;
      border: none;
      cursor: pointer;
      transition: 0.2s ease;
    }

    .btn-delete:hover {
      background-color: #fecaca;
    }

    .inline {
      display: inline;
    }

    .text-center {
      text-align: center;
    }

    .no-feedback {
      text-align: center;
      margin-top: 2rem;
      color: #6b7280;
      font-style: italic;
    }

    .pagination {
      margin-top: 1.5rem;
    }
  </style>

  <div class="feedback-container">
    <h1>📬 Kritik & Saran</h1>

    @if(session('success'))
      <div class="success-alert">
        {{ session('success') }}
      </div>
    @endif

    @if($feedbacks->count())
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Pesan</th>
            <th>Tanggal</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($feedbacks as $feedback)
            <tr>
              <td>{{ $feedback->id }}</td>
              <td>{{ $feedback->name }}</td>
              <td>{{ $feedback->email }}</td>
              <td title="{{ $feedback->message }}">{{ \Illuminate\Support\Str::limit($feedback->message, 50) }}</td>
              <td>{{ $feedback->created_at->format('d M Y') }}</td>
              <td class="text-center">
                <a href="{{ route('kritiksaran.show', $feedback->id) }}" class="btn-link">Lihat</a>
                <form action="{{ route('kritiksaran.destroy', $feedback->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus feedback ini?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-delete">Hapus</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="pagination">
        {{ $feedbacks->links() }}
      </div>
    @else
      <p class="no-feedback">Belum ada feedback yang masuk.</p>
    @endif
  </div>
</x-layouts.app>
