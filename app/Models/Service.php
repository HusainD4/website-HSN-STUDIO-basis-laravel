<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    // Jika kamu menggunakan timestamps (created_at, updated_at), biarkan default (true)
    public $timestamps = true;

    // Kolom-kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'name',
        'description',
        'price',      // pastikan kolom ini ada di tabel
        'image_url',  // pastikan kolom ini ada di tabel
    ];

    // Jika ingin mengubah nama tabel secara eksplisit (opsional)
    // protected $table = 'services';

    // Casting tipe data atribut
    protected $casts = [
        'price' => 'decimal:2',
    ];
}
