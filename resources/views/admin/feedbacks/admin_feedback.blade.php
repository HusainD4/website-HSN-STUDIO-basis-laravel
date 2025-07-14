<x-layouts.app :title="'Daftar Feedback'">

    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Daftar Feedback</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($feedbacks->count())
            <table class="min-w-full bg-white border border-gray-200 rounded">
                <thead>
                    <tr>
                        <th class="border px-4 py-2 text-left">ID</th>
                        <th class="border px-4 py-2 text-left">Nama</th>
                        <th class="border px-4 py-2 text-left">Email</th>
                        <th class="border px-4 py-2 text-left">Pesan</th>
                        <th class="border px-4 py-2 text-left">Tanggal</th>
                        <th class="border px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedbacks as $feedback)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $feedback->id }}</td>
                        <td class="border px-4 py-2">{{ $feedback->name }}</td>
                        <td class="border px-4 py-2">{{ $feedback->email }}</td>
                        <td class="border px-4 py-2 truncate max-w-xs" title="{{ $feedback->message }}">{{ Str::limit($feedback->message, 50) }}</td>
                        <td class="border px-4 py-2">{{ $feedback->created_at->format('d M Y') }}</td>
                        <td class="border px-4 py-2 text-center space-x-2">
                            <a href="{{ route('kritiksaran.show', $feedback->id) }}" class="text-blue-600 hover:underline">Lihat</a>

                            <form action="{{ route('kritiksaran.destroy', $feedback->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus feedback ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $feedbacks->links() }}
            </div>
        @else
            <p class="text-gray-600">Belum ada feedback yang masuk.</p>
        @endif
    </div>

</x-layouts.app>
