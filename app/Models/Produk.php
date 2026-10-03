<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'kategori',
        'kategori_produk',
        'nama',
        'slug',
        'deskripsi_lengkap',
        'gambar',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}