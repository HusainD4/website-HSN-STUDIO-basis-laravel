<div style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.4); z-index: 50; display: flex; justify-content: center; align-items: center;">
  <div style="background-color: #fff; padding: 2rem; border-radius: 1rem; width: 100%; max-width: 600px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); font-family: 'Poppins', sans-serif;">
    
    <h2 style="font-size: 1.5rem; font-weight: bold; color: #ec4899; margin-bottom: 1.5rem;">
      {{ $editMode ? 'Edit Produk' : 'Tambah Produk' }}
    </h2>

    <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}">
      
      <!-- Nama -->
      <div style="margin-bottom: 1rem;">
        <label for="name" style="font-weight: 600; color: #3b82f6; display: block;">Nama Produk</label>
        <input type="text" id="name" wire:model.defer="product.name"
               style="width: 100%; padding: 0.5rem; border: 1px solid #93c5fd; border-radius: 0.75rem;">
        @error('product.name') <small style="color: red;">{{ $message }}</small> @enderror
      </div>

      <!-- Harga -->
      <div style="margin-bottom: 1rem;">
        <label for="price" style="font-weight: 600; color: #3b82f6; display: block;">Harga</label>
        <input type="number" id="price" wire:model.defer="product.price"
               style="width: 100%; padding: 0.5rem; border: 1px solid #93c5fd; border-radius: 0.75rem;">
        @error('product.price') <small style="color: red;">{{ $message }}</small> @enderror
      </div>

      <!-- Stok -->
      <div style="margin-bottom: 1rem;">
        <label for="stock" style="font-weight: 600; color: #3b82f6; display: block;">Stok</label>
        <input type="number" id="stock" wire:model.defer="product.stock"
               style="width: 100%; padding: 0.5rem; border: 1px solid #93c5fd; border-radius: 0.75rem;">
        @error('product.stock') <small style="color: red;">{{ $message }}</small> @enderror
      </div>

      <!-- Deskripsi -->
      <div style="margin-bottom: 1rem;">
        <label for="description" style="font-weight: 600; color: #3b82f6; display: block;">Deskripsi</label>
        <textarea id="description" wire:model.defer="product.description" rows="3"
                  style="width: 100%; padding: 0.5rem; border: 1px solid #93c5fd; border-radius: 0.75rem;"></textarea>
        @error('product.description') <small style="color: red;">{{ $message }}</small> @enderror
      </div>

      <!-- Tombol -->
      <div style="text-align: right;">
        <button type="submit"
                style="background-color: #f472b6; color: white; border: none; padding: 0.5rem 1.25rem; border-radius: 0.75rem; font-weight: 600; box-shadow: 0 4px 12px rgba(244, 114, 182, 0.3);">
          {{ $editMode ? 'Update' : 'Simpan' }}
        </button>
        <button type="button" wire:click="$emit('closeModal')"
                style="background-color: #e5e7eb; border: none; padding: 0.5rem 1.25rem; border-radius: 0.75rem; margin-left: 0.5rem;">
          Batal
        </button>
      </div>
    </form>
  </div>
</div>
