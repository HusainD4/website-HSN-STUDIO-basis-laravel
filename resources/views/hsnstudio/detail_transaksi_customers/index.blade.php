@extends('hsnstudio.layouts.app')

@section('title', 'Transaksi Saya')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Daftar Transaksi Saya</h3>

    @if ($transactions->isEmpty())
        <div class="alert alert-info">Belum ada transaksi yang tercatat.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            <td>
                                @if ($item->action == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($item->action == 'cancel')
                                    <span class="badge bg-danger">Dibatalkan</span>
                                @elseif ($item->action == 'dikirim')
                                    <span class="badge bg-primary">Dikirim</span>
                                @elseif ($item->action == 'sukses')
                                    <span class="badge bg-success">Sukses</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
