<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionItem;

class TransactionItemController extends Controller
{
    /**
     * Update status (action) dari item transaksi.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TransactionItem $transactionItem
     * @return \Illuminate\Http\JsonResponse
     */
    // public function updateAction(Request $request, TransactionItem $transactionItem)
    // {
    //     // Validasi input
    //     $validated = $request->validate([
    //         'action' => ['required', 'in:pending,cancel,dikirim,sukses'],
    //     ]);

    //     try {
    //         $transactionItem->action = $validated['action'];
    //         $transactionItem->save();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Status berhasil diperbarui.',
    //             'data' => [
    //                 'id' => $transactionItem->id,
    //                 'action' => $transactionItem->action,
    //             ],
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Terjadi kesalahan saat memperbarui status.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    public function updateAction(Request $request, TransactionItem $transactionItem)
    {
        $request->validate([
            'action' => 'required|in:pending,cancel,dikirim,sukses',
        ]);

        $transactionItem->action = $request->input('action');
        $transactionItem->save();

        return response()->json(['message' => 'Status berhasil diperbarui']);
    }

}
