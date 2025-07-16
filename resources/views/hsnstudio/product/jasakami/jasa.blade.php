@extends('hsnstudio.layouts.app')

@section('title', 'Jasa Kami - HSN Studio')

@section('content')
<section class="section bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Jasa Kami</h2>

        <div class="row">
            @forelse($services as $service)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $service->image_url) }}" class="card-img-top" alt="{{ $service->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $service->name }}</h5>
                            <p class="card-text">{{ Str::limit($service->description, 100) }}</p>
                            <a href="{{ route('jasa.detail', $service->id) }}" class="btn btn-primary">Detail Jasa</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada jasa yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
