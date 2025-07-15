<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionItem;

class TransactionItemController extends Controller
{
    /**
     * Update status (action) dari item transaksi.
     */
    public function updateAction(Request $request, TransactionItem $item)
    {
        // Validasi request
        $validated = $request->validate([
            'action' => ['required', 'in:pending,cancel,dikirim,sukses'],
        ]);

        // Update dan simpan ke database
        $item->action = $validated['action'];

        if ($item->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui.',
                'data' => [
                    'id' => $item->id,
                    'action' => $item->action,
                ],
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan status.',
            ], 500);
        }
    }
}
