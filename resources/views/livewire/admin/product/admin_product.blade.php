<?php

use Livewire\Volt\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

// Mendefinisikan komponen Livewire Volt
new class extends Component {
    use WithPagination;

    // PERBAIKAN: Mengubah metode delete agar menerima ID, bukan model.
    // Ini adalah cara yang lebih aman dan standar untuk Livewire.
    public function delete($productId)
    {
        // Cari produk berdasarkan ID, atau gagal jika tidak ditemukan.
        $product = Product::findOrFail($productId);

        // Hapus gambar dari storage jika ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Hapus produk dari database
        $product->delete();

        // Beri pesan sukses
        session()->flash('success', 'Produk berhasil dihapus.');

        // Redirect kembali ke halaman produk
        return $this->redirect(route('admin.products.index'), navigate: true);
    }

    // Metode untuk mengambil data produk dan mengirimkannya ke view
    public function with(): array
    {
        return [
            'products' => Product::orderBy('created_at', 'desc')->paginate(10),
        ];
    }
};

?>

<div>
    {{-- Header Halaman --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-zinc-800 dark:text-zinc-200">
            {{ __('Manajemen Produk') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:p-6 lg:p-8">
        <div class="mx-auto max-w-7xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-zinc-800 dark:text-zinc-200">Daftar Produk</h3>
                    <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                        Kelola semua produk yang tersedia di toko Anda.
                    </p>
                </div>
                {{-- Tombol untuk menambah produk baru --}}
                <a href="{{ route('admin.products.create') }}" wire:navigate>
                    <x-button :label="__('Tambah Produk Baru')" />
                </a>
            </div>

            {{-- Menampilkan pesan sukses jika ada --}}
            @if (session('success'))
                <div class="mt-4 rounded-lg bg-emerald-100 p-4 text-sm text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-400" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tabel untuk menampilkan data produk --}}
            <div class="mt-6 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-zinc-300 dark:divide-zinc-700">
                                <thead class="bg-zinc-50 dark:bg-zinc-800">
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-zinc-900 dark:text-white sm:pl-6">Gambar</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">Nama</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">Harga</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-zinc-900 dark:text-white">Stok</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Aksi</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-200 bg-white dark:bg-zinc-900">
                                    @forelse ($products as $product)
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-zinc-900 dark:text-white sm:pl-6">
                                                <img src="{{ $product->image ? Storage::url($product->image) : 'https://placehold.co/60x60/EFEFEF/A9A9A9?text=N/A' }}" alt="{{ $product->name }}" class="h-12 w-12 rounded-lg object-cover">
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-500 dark:text-zinc-300">{{ $product->name }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-500 dark:text-zinc-300">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-500 dark:text-zinc-300">{{ $product->stock ?? 0 }}</td>
                                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" wire:navigate>Edit</a>
                                                {{-- PERBAIKAN: Mengirim ID produk sebagai integer, bukan string. --}}
                                                <button wire:click="delete({{ $product->id }})" wire:confirm="Apakah Anda yakin ingin menghapus produk ini?" class="ml-4 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="whitespace-nowrap px-3 py-4 text-center text-sm text-zinc-500 dark:text-zinc-400">
                                                Belum ada produk yang ditambahkan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- Navigasi Halaman --}}
                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
