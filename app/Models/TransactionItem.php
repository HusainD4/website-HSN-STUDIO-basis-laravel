<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $fillable = [
        'transaction_id',
        'product_id',
        'product_name',
        'quantity',
        'price',
        'subtotal',
        'action', // pastikan kolom ini juga bisa diisi
    ];

    public function transaction()
    {
        return $this->belongsTo(\App\Models\Transaction::class);
    }
}
