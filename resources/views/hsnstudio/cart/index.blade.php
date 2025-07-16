@extends('hsnstudio.layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #fceff9 0%, #fff 50%, #d0f4ff 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container h2 {
        color: #db2777;
        font-weight: 800;
        text-shadow: 1px 1px 0 #ffd6e8;
    }

    table.table {
        background-color: #fff;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(219, 39, 119, 0.08);
    }

    thead {
        background-color: #ffe0f0;
        color: #d6336c;
    }

    tbody td {
        vertical-align: middle;
    }

    .btn-danger,
    .btn-warning,
    .btn-success,
    .btn-primary {
        border-radius: 0.5rem;
        font-weight: 600;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .btn-danger:hover {
        background-color: #c92a2a;
    }

    .btn-warning {
        background-color: #ffe066;
        color: #5c3d00;
        border: none;
    }

    .btn-warning:hover {
        background-color: #ffd43b;
    }

    .btn-success {
        background-color: #b2f2bb;
        color: #2f9e44;
        border: none;
    }

    .btn-success:hover {
        background-color: #69db7c;
    }

    .btn-primary {
        background-color: #a5d8ff;
        color: #1c1c1c;
        border: 1px solid #74c0fc;
    }

    .btn-primary:hover {
        background-color: #74c0fc;
        color: #000;
    }

    .modal-header {
        background: #ffe0f0;
        color: #d6336c;
        border-bottom: none;
    }

    .modal-title {
        font-weight: bold;
    }

    .modal-content {
        border-radius: 1rem;
        border: 2px solid #f3d9ec;
        box-shadow: 0 10px 25px rgba(219, 39, 119, 0.2);
    }

    .modal-body label {
        font-weight: 600;
        color: #495057;
    }

    .form-control {
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
    }

    .form-control:focus {
        border-color: #db2777;
        box-shadow: 0 0 0 0.2rem rgba(219, 39, 119, 0.25);
    }
    .action-buttons {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

</style>
<div class="container py-5">
    <h2 class="mb-4">Keranjang Belanja</h2>

    @if(session('cart') && count(session('cart')))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach(session('cart') as $item)
                    @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td colspan="2"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>

        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkoutModal">Checkout</button>
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button class="btn btn-warning">Kosongkan Keranjang</button>
        </form>
    @else
        <p class="text-muted">Keranjang masih kosong.</p>
    @endif
</div>

<!-- Tombol Checkout -->

<!-- Modal Checkout -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('cart.checkout') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Form Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone">Nomor HP</label>
                    <input type="text" class="form-control" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="address">Alamat</label>
                    <textarea class="form-control" name="address" rows="3" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Proses Checkout</button>
            </div>
        </form>
    </div>
</div>

@endsection
