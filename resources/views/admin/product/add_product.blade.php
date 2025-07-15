<x-layouts.app :title="'Tambah Produk'">

<style>
  body {
    background-color: #fdf2f8; /* pink-50 */
  }

  .form-input,
  .form-select,
  .form-textarea {
    width: 100%;
    padding: 0.5rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border: 1px solid #ec4899; /* pink-500 */
    border-radius: 0.5rem;
    background-color: white;
    color: #1e293b;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    box-sizing: border-box;
    font-family: inherit;
    resize: vertical;
    margin-bottom: 0.75rem;
  }

  .form-input:focus,
  .form-select:focus,
  .form-textarea:focus {
    outline: none;
    border-color: #d946ef;
    box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.3);
  }

  label {
    margin-bottom: 0.25rem;
    display: block;
    color: #be185d; /* pink-800 */
    font-weight: 600;
  }

  button[type="submit"] {
    cursor: pointer;
    font-weight: 600;
    background-color: #f472b6; /* pink-400 */
    color: #000000;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    border: none;
    box-shadow: 0 2px 8px rgba(244, 114, 182, 0.4);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    display: inline-block;
  }

  button[type="submit"]:hover {
    background-color: #ec4899;
    box-shadow: 0 4px 15px rgba(236, 72, 153, 0.6);
    color: #000000;
  }

  .bg-red-100 {
    background-color: #fee2e2;
    color: #b91c1c;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
  }

  .list-disc {
    list-style-type: disc;
    padding-left: 1.25rem;
  }

  .p-6 {
    padding: 1.5rem;
  }

  .max-w-xl {
    max-width: 36rem;
    margin-left: auto;
    margin-right: auto;
  }

  h1 {
    color: #be185d;
    text-align: center;
    margin-bottom: 1rem;
  }
</style>

<div class="p-6 max-w-xl mx-auto bg-white rounded-lg shadow-md">
  <h1 class="text-2xl font-semibold">Tambah Produk</h1>

  @if ($errors->any())
    <div class="bg-red-100">
      <ul class="list-disc ml-5">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf

    <div>
      <label for="name">Nama Produk <span class="text-red-600">*</span></label>
      <input type="text" name="name" id="name" class="form-input" value="{{ old('name') }}" required autofocus>
    </div>

    <div>
      <label for="category_id">Kategori <span class="text-red-600">*</span></label>
      <select name="category_id" id="category_id" class="form-select" required>
        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>-- Pilih Kategori --</option>
        @foreach ($categories as $cat)
          <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
            {{ $cat->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div>
      <label for="price">Harga (Rp) <span class="text-red-600">*</span></label>
      <input type="number" name="price" id="price" class="form-input" value="{{ old('price') }}" min="0" step="100" required>
    </div>

    <div>
      <label for="description">Deskripsi <span class="text-red-600">*</span></label>
      <textarea name="description" id="description" rows="4" class="form-textarea" required>{{ old('description') }}</textarea>
    </div>

    <div>
      <label for="image">Gambar Produk <span class="text-red-600">*</span></label>
      <input type="file" name="image" id="image" class="form-input" accept="image/*" required>
    </div>

    <div class="mt-4">
      <button type="submit">Simpan</button>
    </div>
  </form>
</div>
</x-layouts.app>
