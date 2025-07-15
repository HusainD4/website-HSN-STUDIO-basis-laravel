<x-layouts.app :title="'Kritik & Saran'">
    <style>
        body {
            background: linear-gradient(135deg, #cce5ff, #ffffff, #ffe0f0);
            font-family: 'Segoe UI', 'Comic Sans MS', cursive, sans-serif;
        }

        .feedback-container {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(236, 72, 153, 0.1);
            border: 2px solid #fbcfe8;
        }

        h1 {
            font-size: 2rem;
            font-weight: 800;
            color: #ec4899;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f0f9ff;
            color: #1e40af;
            text-align: left;
            padding: 12px;
            font-size: 0.95rem;
        }

        td {
            padding: 12px;
            border-top: 1px solid #e5e7eb;
            font-size: 0.95rem;
            color: #374151;
        }

        tr:hover {
            background-color: #fdf2f8;
        }

        .success-alert {
            background-color: #d1fae5;
            color: #065f46;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 12px;
            font-weight: 600;
        }

        .btn-link {
            color: #3b82f6;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .btn-delete {
            color: #ef4444;
            font-weight: 600;
            background: none;
            border: none;
            cursor: pointer;
        }

        .btn-delete:hover {
            text-decoration: underline;
        }

        .no-feedback {
            text-align: center;
            color: #6b7280;
            padding: 1rem;
        }

        .pagination {
            margin-top: 1.5rem;
        }
    </style>

    <div class="feedback-container">
        <h1>📬 Kritik Dan Saran</h1>

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

                                <form action="{{ route('kritiksaran.destroy', $feedback->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus feedback ini?');">
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
