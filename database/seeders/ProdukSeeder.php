<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use Illuminate\Support\Str;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriList = ['PPLG', 'TPFL', 'TO', 'TJKT'];

        foreach ($kategoriList as $kode) {
            for ($i = 1; $i <= 3; $i++) {
                $nama = 'Lanyard Costum';

                Produk::create([
                    'kategori'          => $kode,
                    'kategori_produk'   => 'Aksesoris & Kerajinan',
                    'nama'              => $nama,
                    'slug'              => Str::slug($nama) . '-' . strtolower($kode) . '-' . $i,
                    'deskripsi_singkat' => 'Lanyard hasil karya siswa yang dibuat dengan desain menarik dan bahan berkualitas.',
                    'deskripsi_lengkap' => 'Lanyard hasil karya siswa SMKN 4 Kota Bogor yang dibuat melalui proses pembelajaran berbasis praktik. Menggunakan bahan berkualitas dan desain custom sesuai kreativitas siswa.',
                    'gambar'            => 'produk-lanyard.jpg',
                    'tanggal'           => '2025-11-17',
                ]);
            }
        }
    }
}