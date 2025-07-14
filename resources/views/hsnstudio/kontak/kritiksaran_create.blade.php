
@extends('hsnstudio.layouts.app')

@section('title', 'Daftar Kritik & Saran')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Daftar Kritik & Saran</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($feedbacks->count())
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feedbacks as $index => $feedback)
                        <tr>
                            <td>{{ $feedbacks->firstItem() + $index }}</td>
                            <td>{{ $feedback->name }}</td>
                            <td>{{ $feedback->email }}</td>
                            <td>{{ $feedback->message }}</td>
                            <td>{{ $feedback->created_at->format('d M Y') }}</td>
                            <td>
                                <form action="{{ route('kritiksaran.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $feedbacks->links() }}
        </div>
    @else
        <div class="alert alert-info text-center">
            Belum ada kritik dan saran yang masuk.
        </div>
    @endif
</div>
@endsection
