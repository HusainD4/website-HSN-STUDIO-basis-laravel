<x-layouts.app :title="'Detail Transaksi'">
    <style>
        body {
            background: linear-gradient(to bottom right, #a5d8ff, #ffffff, #ffc8dd);
        }

        .box-shadow-pastel {
            box-shadow: 0 8px 24px rgba(165, 216, 255, 0.3), 0 4px 12px rgba(255, 200, 221, 0.2);
        }

        .select-pastel {
            background-color: #fff0f6;
            border-color: #ffc8dd;
            color: #d6336c;
            font-weight: 600;
            padding: 0.4rem 0.75rem;
        }

        .btn-update {
            background-color: #ffc8dd;
            color: #72163c;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid #ffc8dd;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-update:hover {
            background-color: #faa2c1;
            color: #500724;
        }

        .btn-update:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .badge-success {
            background-color: #d3f9d8;
            color: #2f9e44;
        }

        .badge-pending {
            background-color: #ffe066;
            color: #7c5b00;
        }

        .badge-cancel {
            background-color: #ffa8a8;
            color: #8b0000;
        }

        .badge-dikirim {
            background-color: #a5d8ff;
            color: #0b5394;
        }
    </style>

    <div class="max-w-5xl mx-auto py-10 px-6">

        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-pink-600 drop-shadow-sm mb-2">💌 Detail Pesananmu 💌</h1>
            <p class="text-lg text-blue-700">ID Transaksi: #{{ $transaction->id }}</p>
        </div>

        {{-- Alert sukses --}}
        <div id="success-alert" class="hidden bg-green-100 border-l-4 border-green-400 text-green-800 p-4 rounded-lg mb-6" role="alert">
            <p class="font-bold">Yeay! ✅</p>
            <p id="success-message">Status pesanan berhasil diupdate!</p>
        </div>

        {{-- Grid utama --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Info Pembeli --}}
            <div class="lg:col-span-1 bg-white rounded-xl border border-pink-300 p-6 box-shadow-pastel">
                <h3 class="text-2xl font-bold text-pink-600 border-b border-pink-200 pb-3 mb-4">🧾 Info Pembeli</h3>
                <div class="space-y-4 text-base text-gray-700">
                    <p><strong class="text-pink-500">Nama:</strong><br>{{ $transaction->name }}</p>
                    <p><strong class="text-pink-500">Email:</strong><br>{{ $transaction->email }}</p>
                    <p><strong class="text-pink-500">Telepon:</strong><br>{{ $transaction->phone }}</p>
                    <p><strong class="text-pink-500">Alamat:</strong><br>{{ $transaction->address }}</p>
                    <p><strong class="text-pink-500">Tanggal:</strong><br>{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            {{-- Barang Pesanan --}}
            <div class="lg:col-span-2 bg-white rounded-xl border border-blue-300 box-shadow-pastel">
                <h3 class="text-2xl font-bold text-blue-700 border-b border-blue-200 p-6">📦 Barang Pesanan</h3>
                @if($transaction->items->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-blue-50 text-blue-700 text-left text-sm font-bold">
                                <tr>
                                    <th class="px-6 py-3">Produk</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-blue-100 text-gray-700">
                                @foreach($transaction->items as $item)
                                    <tr id="item-row-{{ $item->id }}">
                                        <td class="px-6 py-4">
                                            <div class="text-pink-600 font-bold text-lg">{{ $item->product_name }}</div>
                                            <div class="text-sm">{{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <select id="action-select-{{ $item->id }}" class="w-full rounded-xl border shadow select-pastel" aria-label="Pilih status produk">
                                                @foreach(['pending', 'cancel', 'dikirim', 'sukses'] as $status)
                                                    <option value="{{ $status }}" @if($item->action === $status) selected @endif>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="px-6 py-4">
                                            <button
                                                data-id="{{ $item->id }}"
                                                class="update-button btn-update px-5 py-2 rounded-full border border-pink-300 hover:shadow-lg transition"
                                                type="button"
                                            >
                                                Update
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 bg-blue-50 border-t-2 border-blue-200 flex justify-end items-center">
                        <span class="text-base font-semibold text-blue-800 mr-3">Total:</span>
                        <span class="text-2xl font-bold text-pink-600">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                    </div>
                @else
                    <p class="p-6 text-center text-gray-500">Belum ada produk di pesanan ini 😢</p>
                @endif
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="text-center mt-10">
            <a href="{{ route('admin.transactions.index') }}"
                class="inline-flex items-center px-6 py-3 border-2 border-pink-300 bg-[#a5d8ff] text-pink-800 rounded-full text-lg font-bold shadow-sm hover:bg-[#ffc8dd] hover:text-pink-900 transition-all duration-300 hover:scale-105"
            >
                ← Kembali ke Daftar
            </a>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.update-button').forEach(button => {
                    button.addEventListener('click', function () {
                        const itemId = this.dataset.id;
                        const select = document.getElementById(`action-select-${itemId}`);
                        const newAction = select.value;
                        const originalText = this.innerHTML;
                        const button = this;

                        button.disabled = true;
                        button.innerHTML = `<svg class="animate-spin h-5 w-5 mx-auto text-pink-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>`;

                        fetch(`/admin/transaction-items/${itemId}/action`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ action: newAction })
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => { throw new Error(err.message || 'Terjadi kesalahan.'); });
                            }
                            return response.json();
                        })
                        .then(data => {
                            const alertBox = document.getElementById('success-alert');
                            document.getElementById('success-message').textContent = data.message || 'Status pesanan berhasil diupdate!';
                            alertBox.classList.remove('hidden');
                            setTimeout(() => alertBox.classList.add('hidden'), 3000);
                        })
                        .catch(err => alert(err.message))
                        .finally(() => {
                            button.disabled = false;
                            button.innerHTML = originalText;
                        });
                    });
                });
            });
        </script>
    @endpush
</x-layouts.app>
