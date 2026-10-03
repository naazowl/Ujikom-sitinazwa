<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
        'logo',
        'foto_kegiatan',
        'prestasi',
        'prospek_karier',
    ];

    protected $casts = [
        'prestasi'       => 'array',
        'prospek_karier' => 'array',
    ];
}