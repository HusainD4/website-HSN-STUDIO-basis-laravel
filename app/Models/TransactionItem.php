<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Http\Controllers\Controller;

class TransactionItem extends Model
{
    // Izinkan pengisian massal untuk kolom-kolom berikut
    protected $fillable = [
        'transaction_id',
        'product_id',
        'product_name',
        'quantity',
        'price',
        'subtotal',
        'action', // penting agar bisa diupdate via request PATCH
    ];

    /**
     * Relasi ke model Transaction
     */
    public function transaction()
    {
        return $this->belongsTo(\App\Models\Transaction::class);
        

    }

    
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

        public function updateMultiple(Request $request, Transaction $transaction)
        {
            $items = $request->input('items', []);

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
