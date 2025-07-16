<x-layouts.app :title="'Detail Transaksi'">
    <style>
body {
    background: linear-gradient(135deg, #a5d8ff 0%, #ffffff 50%, #ffc8dd 100%);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
}

.max-w-5xl {
    max-width: 180rem; /* 1280px */
    margin-left: auto;
    margin-right: auto;
    padding-left: 1.5rem;  /* px-6 */
    padding-right: 1.5rem;
    padding-top: 2.5rem; /* py-10 */
    padding-bottom: 2.5rem;
}

.text-center {
    text-align: center;
    margin-bottom: 2.5rem; /* mb-10 */
}

h1.text-4xl {
    font-size: 2.25rem; /* text-4xl */
    font-weight: 800;
    color: #d6336c; /* text-pink-600 */
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    margin-bottom: 0.5rem;
}

p.text-lg {
    font-size: 1.125rem;
    color: #1864ab; /* text-blue-700 */
}

.box-shadow-pastel {
    box-shadow:
        0 8px 24px rgba(165, 216, 255, 0.3),
        0 4px 12px rgba(255, 200, 221, 0.2);
    border-radius: 0.75rem;
    background-color: white;
    border: 1px solid transparent;
}

.bg-white {
    background-color: white;
}

.border-pink-300 {
    border-color: #ffa3b1;
}

.border-blue-300 {
    border-color: #7ea8f7;
}

.rounded-xl {
    border-radius: 1rem;
}

.p-6 {
    padding: 1.5rem;
}

.mb-4 {
    margin-bottom: 1rem;
}

.text-2xl {
    font-size: 1.5rem;
    font-weight: 700;
}

.font-bold {
    font-weight: 700;
}

.text-pink-600 {
    color: #d6336c;
}

.border-b {
    border-bottom-width: 1px;
}

.border-pink-200 {
    border-color: #ffc8dd;
}

.border-blue-200 {
    border-color: #bbd7ff;
}

.text-blue-700 {
    color: #1864ab;
}

.text-gray-700 {
    color: #374151;
}

.space-y-4 > * + * {
    margin-top: 1rem;
}

.grid {
    display: grid;
    gap: 2rem;
}

.grid-cols-1 {
    grid-template-columns: 1fr;
}

.lg\:grid-cols-3 {
    grid-template-columns: repeat(3, 1fr);
}

.lg\:col-span-1 {
    grid-column: span 1 / span 1;
}

.lg\:col-span-2 {
    grid-column: span 2 / span 2;
}

.overflow-x-auto {
    overflow-x: auto;
}

.min-w-full {
    min-width: 100%;
}

.table thead tr {
    background-color: #e6f0ff; /* light blue */
    color: #1864ab;
    font-weight: 700;
}

.table tbody tr:not(:last-child) {
    border-bottom: 1px solid #bbd7ff;
}

.px-6 {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}

.py-3 {
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
}

.py-4 {
    padding-top: 1rem;
    padding-bottom: 1rem;
}

.font-semibold {
    font-weight: 600;
}

.text-pink-500 {
    color: #e64980;
}

.text-base {
    font-size: 1rem;
}

.text-sm {
    font-size: 0.875rem;
}

.mb-6 {
    margin-bottom: 1.5rem;
}

.flex {
    display: flex;
}

.items-center {
    align-items: center;
}

.gap-4 {
    gap: 1rem;
}

.w-48 {
    width: 12rem;
}

.select-pastel {
    background-color: #fff0f6;
    border: 1.5px solid #ffc8dd;
    color: #d6336c;
    font-weight: 600;
    padding: 0.4rem 0.75rem;
    border-radius: 0.75rem;
    cursor: pointer;
    transition: box-shadow 0.3s ease, border-color 0.3s ease;
}

.select-pastel:hover,
.select-pastel:focus {
    box-shadow: 0 0 8px rgba(214, 51, 108, 0.6);
    border-color: #d6336c;
    outline: none;
}

.btn-pastel {
    background-color: #a5d8ff;
    color: #1c1c1c;
    border: 1px solid #91a7ff;
    padding: 0.5rem 1.25rem;
    border-radius: 0.5rem;
    font-weight: 700;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
    box-shadow: 0 2px 6px rgba(165, 216, 255, 0.6);
}

.btn-pastel:hover,
.btn-pastel:focus {
    background-color: #ffc8dd;
    color: #000000;
    outline: none;
    box-shadow: 0 2px 12px rgba(255, 200, 221, 0.8);
}

#success-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 10000;
    background-color: #d3f9d8;
    border-left: 5px solid #2f9e44;
    color: #2f9e44;
    padding: 1rem 1.5rem;
    border-radius: 0.5rem;
    box-shadow: 0 3px 12px rgba(47, 158, 68, 0.45);
    font-weight: 600;
    display: none;
    max-width: 280px;
    font-size: 1rem;
    user-select: none;
    animation: fadeInOut 3s forwards;
}

@keyframes fadeInOut {
    0% {
        opacity: 0;
        transform: translateY(-10px);
    }

    10% {
        opacity: 1;
        transform: translateY(0);
    }

    90% {
        opacity: 1;
        transform: translateY(0);
    }

    100% {
        opacity: 0;
        transform: translateY(-10px);
    }
}

/* Tambahan margin agar tidak berdempetan */
h3 {
    margin-bottom: 1.25rem; /* untuk jarak bawah judul */
}

table td, table th {
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
}

tbody tr:hover {
    background-color: #fef2f7;
}

/* Container grid spacing sudah cukup, tapi kita kasih padding tambahan ke item */
.lg\:col-span-1, .lg\:col-span-2 {
    padding: 1rem;
}

/* Tombol kembali */
.text-center.mt-10 {
    margin-top: 2.5rem;
}

a.inline-flex {
    display: inline-flex;
    align-items: center;
    padding-left: 1.5rem;
    padding-right: 1.5rem;
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
    border-width: 2px;
    border-radius: 9999px;
    font-size: 1.125rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s ease;
}

a.inline-flex:hover {
    transform: scale(1.05);
}

    </style>

    <div class="max-w-5xl mx-auto py-10 px-6">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold text-pink-600 drop-shadow-sm mb-2">💌 Detail Pesananmu 💌</h1>
            <p class="text-lg text-blue-700">ID Transaksi: #{{ $transaction->id }}</p>
        </div>

        <div id="success-alert" role="alert">Status pesanan berhasil diupdate!</div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
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

            <div class="lg:col-span-2 bg-white rounded-xl border border-blue-300 box-shadow-pastel">
                <h3 class="text-2xl font-bold text-blue-700 border-b border-blue-200 p-6 ">📦 Barang Pesanan</h3>

                @if($transaction->items->count() > 0)
                    <form id="update-status-form" class="px-6 pb-6">
                        <div class="mb-6 flex items-center gap-4">
                            <label for="bulk-status" class="font-semibold text-blue-700 ">Status Pesanan:</label>
                            <select id="bulk-status" name="bulk_status" class="select-pastel w-48" aria-label="Ubah status semua produk">
                                @foreach(['pending', 'cancel', 'dikirim', 'sukses'] as $status)
                                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn-pastel">Update</button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="bg-blue-50 text-blue-700 text-left text-sm font-bold">
                                    <tr>
                                        <th class="px-6 py-3">Produk</th>
                                        <!-- <th class="px-6 py-3">Status Saat Ini</th> -->
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-blue-100 text-gray-700">
                                    @foreach($transaction->items as $item)
                                        <tr>
                                            <td class="px-6 py-4">
                                                <div class="text-pink-600 font-bold text-lg">{{ $item->product_name }}</div>
                                                <div class="text-sm">{{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                            </td>
                                            <!-- <td class="px-6 py-4">
                                                <span class="inline-block w-full select-pastel bg-gray-100 text-gray-600 cursor-default rounded px-3 py-2">
                                                    {{ ucfirst($item->action) }}
                                                </span>
                                            </td> -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 flex justify-end items-center bg-blue-50 border-t-2 border-blue-200 px-6 py-4">
                            <span class="text-base font-semibold text-blue-800 mr-3">Total:</span>
                            <span class="text-2xl font-bold text-pink-600">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                        </div>
                    </form>
                @else
                    <p class="p-6 text-center text-gray-500">Belum ada produk di pesanan ini 😢</p>
                @endif
            </div>
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('admin.transactions.index') }}"
                class="inline-flex items-center px-6 py-3 border-2 border-pink-300 bg-[#a5d8ff] text-pink-800 rounded-full text-lg font-bold shadow-sm hover:bg-[#ffc8dd] hover:text-pink-900 transition-all duration-300 hover:scale-105"
            >
                ← Kembali ke Daftar
            </a>
        </div>
    </div>

    <script>
        document.getElementById('update-status-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const bulkStatus = form.bulk_status.value;
            const btnSubmit = form.querySelector('button[type="submit"]');
            btnSubmit.disabled = true;

            fetch("{{ route('admin.transactionitems.updateMultiple') }}", {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    transaction_id: {{ $transaction->id }},
                    status: bulkStatus
                })
            })
            .then(res => {
                if (!res.ok) return res.json().then(err => Promise.reject(err.message || 'Terjadi kesalahan'));
                return res.json();
            })
            .then(data => {
                const alertBox = document.getElementById('success-alert');
                alertBox.textContent = data.message || 'Status pesanan berhasil diupdate!';
                alertBox.style.display = 'block';
                setTimeout(() => alertBox.style.display = 'none', 3000);

                // Update tampilan status di tabel sesuai pilihan baru
                const statusSpans = form.querySelectorAll('tbody span');
                statusSpans.forEach(span => {
                    span.textContent = bulkStatus.charAt(0).toUpperCase() + bulkStatus.slice(1);
                });
            })
            .catch(err => {
                alert(err);
            })
            .finally(() => {
                btnSubmit.disabled = false;
            });
        });
    </script>
</x-layouts.app>
