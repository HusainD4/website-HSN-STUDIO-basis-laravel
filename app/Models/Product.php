<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
    ];

    /**
     * Relasi: Produk milik satu kategori
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
}
