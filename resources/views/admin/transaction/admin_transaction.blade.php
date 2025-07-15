<x-layouts.app :title="'Transaksi'">
  <style>
    body {
      background: linear-gradient(to bottom right,  #a5d8ff, #ffffff, #ffc8dd); /* pink-100 ke blue-100 */
    }

    .table-heading {
      font-size: 1.75rem;
      font-weight: 700;
      color: #ec4899;
      margin-bottom: 2rem;
      text-align: center;
    }

    table th {
      background-color: #eff6ff;
      color: #1e40af;
      font-weight: 700;
      text-transform: uppercase;
      font-size: 0.875rem;
      padding: 0.75rem 1rem;
    }

    table td {
      padding: 0.75rem 1rem;
      color: #000000;
    }

    tr:hover {
      background-color: #fdf2f8; /* pink-50 */
    }

    .badge-status {
      padding: 0.35rem 0.75rem;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 600;
      display: inline-block;
    }

    .btn-lihat {
      background-color: #f472b6;
      color: black;
      padding: 0.4rem 0.75rem;
      border-radius: 0.5rem;
      font-weight: 600;
      text-decoration: none;
      box-shadow: 0 2px 5px rgba(244, 114, 182, 0.4);
      transition: background-color 0.3s ease;
    }

    .btn-lihat:hover {
      background-color: #ec4899;
      box-shadow: 0 4px 10px rgba(236, 72, 153, 0.6);
      color: black;
    }

    .box-container {
      background-color: #ffffffcc; /* putih semi-transparan */
      border: 1px solid #dbeafe; /* blue-100 */
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.07);
    }
  </style>

  <div class="py-8">
    <div class="w-full px-6 sm:px-8">
      <div class="box-container">
        <div class="px-0 pt-6 pb-4">
          <h1 class="table-heading">Data Transaksi</h1>

          @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-4">
              {{ session('success') }}
            </div>
          @endif

          @if($transactions->count())
            <div class="overflow-x-auto">
              <table class="w-full text-sm text-black border-collapse">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Total</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-blue-200">
                  @foreach($transactions as $index => $trx)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $trx->name }}</td>
                      <td>{{ $trx->email }}</td>
                      <td>{{ $trx->phone }}</td>
                      <td>{{ $trx->address }}</td>
                      <td><strong>Rp {{ number_format($trx->total, 0, ',', '.') }}</strong></td>
                      <td>{{ $trx->created_at->format('d M Y, H:i') }}</td>
                      <td>
                        @php
                          $statuses = $trx->items->pluck('action')->unique();
                        @endphp
                        @foreach ($statuses as $status)
                          @php
                            $style = match($status) {
                              'pending' => 'background-color:#fde68a;color:#92400e;',
                              'cancel' => 'background-color:#fecaca;color:#991b1b;',
                              'dikirim' => 'background-color:#bfdbfe;color:#1e3a8a;',
                              'sukses' => 'background-color:#bbf7d0;color:#166534;',
                              default => 'background-color:#e5e7eb;color:#374151;'
                            };
                          @endphp
                          <span class="badge-status" style="{{ $style }}">
                            {{ ucfirst($status) }}
                          </span>
                        @endforeach
                      </td>
                      <td>
                        <a href="{{ route('admin.transactions.show', $trx->id) }}" class="btn-lihat">
                          Lihat
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <p class="text-center text-gray-500 italic mt-8">Belum ada transaksi.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-layouts.app>
