<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address', 'total'];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
