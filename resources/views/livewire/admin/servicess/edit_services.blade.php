<x-layouts.app :title="'Edit Service - ' . $service->name">
    <div class="container py-6">
        <h1 class="mb-4 text-2xl font-semibold">Edit Service - {{ $service->name }}</h1>

        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="form-label">Nama Service</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    value="{{ old('name', $service->name) }}" 
                    required
                >
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="4" 
                    class="form-control @error('description') is-invalid @enderror" 
                    required
                >{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="form-label">Harga</label>
                <input 
                    type="number" 
                    name="price" 
                    id="price" 
                    class="form-control @error('price') is-invalid @enderror" 
                    value="{{ old('price', $service->price) }}" 
                    required
                >
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Gambar Saat Ini</label>
                <div class="mb-2">
                    @if($service->image_url)
                        <img src="{{ Storage::url($service->image_url) }}" alt="{{ $service->name }}" class="h-12 mx-auto rounded-md object-cover" />
                    @else
                        <p class="text-muted">Tidak ada gambar</p>
                    @endif
                </div>
                <label for="image" class="form-label">Ganti Gambar (Opsional)</label>
                <input 
                    type="file" 
                    name="image" 
                    id="image" 
                    class="form-control @error('image') is-invalid @enderror" 
                    accept="image/*"
                >
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</x-layouts.app>
