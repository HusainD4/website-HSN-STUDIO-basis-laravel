@extends('hsnstudio.layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Detail Transaksi</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <tr>
                    <th>Nama Produk</th>
                    <td>{{ $transaction->product_name }}</td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>{{ $transaction->quantity }}</td>
                </tr>
                <tr>
                    <th>Harga Satuan</th>
                    <td>Rp {{ number_format($transaction->price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Subtotal</th>
                    <td>Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if ($transaction->action == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif ($transaction->action == 'cancel')
                            <span class="badge bg-danger">Dibatalkan</span>
                        @elseif ($transaction->action == 'dikirim')
                            <span class="badge bg-info text-dark">Dikirim</span>
                        @elseif ($transaction->action == 'sukses')
                            <span class="badge bg-success">Sukses</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Transaksi</th>
                    <td>{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                </tr>
            </table>

            <div class="mt-4">
                <a href="{{ route('transaksi.saya') }}" class="btn btn-secondary">Kembali ke Daftar Transaksi</a>
            </div>
        </div>
    </div>
</div>
@endsection
