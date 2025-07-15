<!-- resources/views/admin/product/edit_product.blade.php -->
<x-layouts.app :title="'Edit Produk'">
    <style>
  /* Style input, select, textarea agar konsisten */
  .form-input,
  .form-select,
  .form-textarea {
    width: 100%;
    padding: 0.5rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border: 1px solid #3b82f6; /* biru Tailwind blue-500 */
    border-radius: 0.375rem; /* rounded-md */
    background-color: white;
    color: #1e293b; /* teks abu gelap */
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    box-sizing: border-box;
    font-family: inherit;
    resize: vertical;
  }

  .form-input:focus,
  .form-select:focus,
  .form-textarea:focus {
    outline: none;
    border-color: #2563eb; /* biru lebih gelap Tailwind blue-600 */
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
    background-color: white;
    color: #1e293b;
  }

  /* Margin bawah untuk input, select, textarea */
  .form-input,
  .form-select,
  .form-textarea {
    margin-bottom: 0.5rem;
  }

  /* Style tombol submit biru dengan teks putih */
  button[type="submit"] {
    cursor: pointer;
    font-weight: 600;
    background-color: #2563eb; /* biru Tailwind blue-600 */
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    border: none;
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.4);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    display: inline-block;
  }

  button[type="submit"]:hover {
    background-color: #1e40af; /* biru lebih gelap Tailwind blue-800 */
    box-shadow: 0 4px 15px rgba(30, 64, 175, 0.6);
  }

  /* Style label */
  label {
    margin-bottom: 0.25rem;
    display: block;
    color: #2563eb; /* biru Tailwind blue-600 */
    font-weight: 600;
  }

  /* Style small info text */
  small.text-gray-500 {
    color: #6b7280; /* abu Tailwind gray-500 */
    font-size: 0.875rem;
  }

  /* Error container */
  .bg-red-100 {
    background-color: #fee2e2;
    color: #b91c1c;
    padding: 0.75rem 1rem;
    border-radius: 0.375rem;
    margin-bottom: 1rem;
  }

  .list-disc {
    list-style-type: disc;
    padding-left: 1.25rem;
  }

  /* Responsive max width container */
  .p-6 {
    padding: 1.5rem;
  }

  .max-w-xl {
    max-width: 36rem;
    margin-left: auto;
    margin-right: auto;
  }

  /* Style gambar produk preview */
  img.h-24 {
    height: 6rem;
    border-radius: 0.375rem;
    object-fit: cover;
  }
</style>

    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-xl font-semibold mb-4">Edit Produk</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-medium">
                    Nama Produk <span class="text-red-600">*</span>
                </label>
                <input type="text" name="name" id="name" class="form-input w-full" 
                       value="{{ old('name', $product->name) }}" required autofocus>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block font-medium">
                    Kategori <span class="text-red-600">*</span>
                </label>
                <select name="category_id" id="category_id" class="form-select w-full" required>
                    <option value="" disabled {{ old('category_id', $product->category_id) ? '' : 'selected' }}>-- Pilih Kategori --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="price" class="block font-medium">
                    Harga (Rp) <span class="text-red-600">*</span>
                </label>
                <input type="number" name="price" id="price" class="form-input w-full" 
                       value="{{ old('price', $product->price) }}" min="0" step="100" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium">
                    Deskripsi <span class="text-red-600">*</span>
                </label>
                <textarea name="description" id="description" rows="4" class="form-textarea w-full" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-6">
                <label for="image" class="block font-medium">
                    Gambar Produk <span class="text-red-600">*</span>
                </label>

                @if($product->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk Saat Ini" class="h-24 rounded">
                    </div>
                @endif

                <input type="file" name="image" id="image" class="form-input w-full" accept="image/*">
                <small class="text-gray-500">Kosongkan jika tidak ingin mengganti gambar.</small>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update
            </button>
        </form>
    </div>
</x-layouts.app>
