<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // Jika kamu menggunakan timestamps (created_at, updated_at), pastikan property ini true (default)
    public $timestamps = true;

    // Kolom-kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'name',
        'description',
        'price',      // tambahkan jika ada harga di table
        'image_url',  // pastikan kolom ini ada di database
    ];

    // Jika kamu ingin mengubah nama tabel secara eksplisit (opsional)
    // protected $table = 'services';

    // Jika kamu ingin mendefinisikan tipe data atribut (casting)
    protected $casts = [
        'price' => 'decimal:2',
    ];
}
