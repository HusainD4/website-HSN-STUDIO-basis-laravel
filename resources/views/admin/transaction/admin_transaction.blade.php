<x-layouts.app :title="'Transaksi'">
    <div class="container py-4">
        <h1 class="mb-4">Data Transaksi</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($transactions->count())
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Total</th>
                            <th>Waktu</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $index => $trx)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $trx->name }}</td>
                                <td>{{ $trx->email }}</td>
                                <td>{{ $trx->phone }}</td>
                                <td>{{ $trx->address }}</td>
                                <td>Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                                <td>{{ $trx->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.transactions.show', $trx->id) }}" class="btn btn-sm btn-info">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Belum ada transaksi.</p>
        @endif
    </div>
</x-layouts.app>
