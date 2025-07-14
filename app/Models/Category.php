<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'brand_name',
    ];

    /**
     * Relasi: Satu kategori punya banyak produk
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
