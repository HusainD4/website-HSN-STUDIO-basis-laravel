<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'is_active',
        'stock',
        'weight',
        'hub_product_id', // Gunakan jika kolom ini ada
        'sku',            // Gunakan jika kolom ini ada
    ];

    /**
     * Tipe data otomatis dikonversi.
     */
    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'float',
        'stock' => 'integer',
        'weight' => 'integer',
    ];

    /**
     * Nilai default atribut (fallback).
     */
    protected $attributes = [
        'is_active' => true,
        'stock' => 9999,
        'weight' => 1000,
    ];

    /**
     * Relasi: Produk milik satu kategori.
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    /**
     * Scope: Ambil hanya produk yang aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
