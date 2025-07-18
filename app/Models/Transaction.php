<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'total',
    ];

    /**
     * Relasi: Satu transaksi memiliki banyak item transaksi
     */
    public function items()
    {
        return $this->hasMany(\App\Models\TransactionItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
