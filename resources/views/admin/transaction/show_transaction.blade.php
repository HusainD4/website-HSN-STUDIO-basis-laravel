<x-layouts.app :title="'Detail Transaksi'">
    <div class="container py-4">
        <h1 class="mb-4">Detail Transaksi #{{ $transaction->id }}</h1>

        <div class="mb-3">
            <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">&larr; Kembali ke Daftar Transaksi</a>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Informasi Pembeli
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $transaction->name }}</p>
                <p><strong>Email:</strong> {{ $transaction->email }}</p>
                <p><strong>Telepon:</strong> {{ $transaction->phone }}</p>
                <p><strong>Alamat:</strong> {{ $transaction->address }}</p>
                <p><strong>Waktu Transaksi:</strong> {{ $transaction->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-secondary text-white">
                Detail Produk
            </div>
            <div class="card-body">
                @if($transaction->items && count($transaction->items) > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaction->items as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total</th>
                                <th>Rp {{ number_format($transaction->total, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                @else
                    <p class="text-muted">Tidak ada produk dalam transaksi ini.</p>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
