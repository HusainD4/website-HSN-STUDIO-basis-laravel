<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
