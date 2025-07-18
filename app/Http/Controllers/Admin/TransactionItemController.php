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
    public function updateMultiple(Request $request, Transaction $transaction)
    {
        $items = $request->input('items', []); // expects array: item_id => [field1=>value,...]
        
        foreach ($items as $itemId => $fields) {
            $item = TransactionItem::where('transaction_id', $transaction->id)
                                    ->where('id', $itemId)
                                    ->first();
            if ($item) {
                $item->update($fields);
            }
        }

        return redirect()->route('admin.transactions.items.show', $transaction->id)
                        ->with('success', 'Item transaksi berhasil diperbarui.');
    }

}
