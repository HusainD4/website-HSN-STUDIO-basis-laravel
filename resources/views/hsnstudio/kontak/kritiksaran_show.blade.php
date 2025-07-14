<x-layouts.app :title="'Detail Feedback'">

@section('title', 'Detail Kritik & Saran')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Detail Kritik & Saran</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $feedback->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $feedback->email }}</h6>
            <p class="card-text mt-3">{{ $feedback->message }}</p>

            <p class="text-muted mt-4">
                Dikirim pada: {{ $feedback->created_at->format('d M Y, H:i') }}
            </p>
        </div>
    </div>

    <div class="mt-4 text-center">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
</x-layouts.app>
