<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionItem;

class TransactionItemController extends Controller
{
    public function updateAction(Request $request, TransactionItem $transactionItem)
    {
        $request->validate([
            'action' => 'required|in:pending,cancel,dikirim,sukses',
        ]);

        $transactionItem->update([
            'action' => $request->action
        ]);

        return response()->json([
            'message' => 'Status pesanan berhasil diperbarui!',
        ]);
    }
    // public function updateMultiple(Request $request)
    // {
    //     $items = $request->input('items', []);

    //     $validActions = ['pending', 'cancel', 'dikirim', 'sukses'];

    //     foreach ($items as $id => $action) {
    //         if (!in_array($action, $validActions)) {
    //             return response()->json(['message' => "Status tidak valid untuk item ID $id"], 422);
    //         }

    //         $item = TransactionItem::find($id);
    //         if ($item) {
    //             $item->action = $action;
    //             $item->save();
    //         }
    //     }

    //     return response()->json(['message' => 'Semua status produk berhasil diperbarui.']);
    // }
    public function updateMultiple(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|integer|exists:transactions,id',
            'status' => 'required|string|in:pending,cancel,dikirim,sukses',
        ]);

        $transactionId = $request->input('transaction_id');
        $status = $request->input('status');

        // Update semua item yang terkait transaction id ini
        \App\Models\TransactionItem::where('transaction_id', $transactionId)
            ->update(['action' => $status]);

        return response()->json([
            'message' => 'Status pesanan berhasil diupdate!',
        ]);
    }

}
