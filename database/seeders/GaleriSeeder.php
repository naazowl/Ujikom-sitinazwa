<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $gambarList = ['galeri-1.JPG', 'galeri-2.jpeg'];

        for ($i = 1; $i <= 11; $i++) {
            Galeri::create([
                'judul'      => 'Kegiatan Neospragma',
                'keterangan' => 'Dokumentasi kegiatan Neospragma SMKN 4 Kota Bogor.',
                'gambar'     => $gambarList[$i % 2],
                'tanggal'    => '2025-11-17',
                'status'     => 'Publik',
            ]);
        }
    }
}