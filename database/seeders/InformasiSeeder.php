<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Informasi;

class InformasiSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'slug' => 'tim-pmr-juara-1',
                'kategori' => 'Prestasi',
                'judul' => 'Tim PMR SMKN 4 Bogor meraih berbagai juara',
                'isi' => 'Kegiatan Penyerahan Penghargaan kepada Seluruh Anggota Tim PMR SMK Negeri 4 Bogor yang telah meraih: Juara Umum, Pertolongan Pertama Putri (Juara Harapan 1), Tandu Putri Regu (Juara 2), Tandu Putra Regu (Juara 1), dan Perawatan Keluarga (Juara 2). Penyerahan Penghargaan ini dilaksanakan di lapangan SMK Negeri 4 Bogor pada hari Senin, 17 November 2025.',
                'tanggal' => '2025-11-17',
                'gambar' => 'berita-1.jpeg',
            ],
            [
                'slug' => 'tim-pmr-juara-2',
                'kategori' => 'Prestasi',
                'judul' => 'Tim PMR SMKN 4 Bogor meraih berbagai juara',
                'isi' => 'Kegiatan Penyerahan Penghargaan kepada Seluruh Anggota Tim PMR SMK Negeri 4 Bogor yang telah meraih: Juara Umum, Pertolongan Pertama Putri (Juara Harapan 1), Tandu Putri Regu (Juara 2), Tandu Putra Regu (Juara 1), dan Perawatan Keluarga (Juara 2). Penyerahan Penghargaan ini dilaksanakan di lapangan SMK Negeri 4 Bogor pada hari Senin, 17 November 2025.',
                'tanggal' => '2025-11-17',
                'gambar' => 'berita-2.jpeg',
            ],
            [
                'slug' => 'tim-pmr-juara-3',
                'kategori' => 'Prestasi',
                'judul' => 'Tim PMR SMKN 4 Bogor meraih berbagai juara',
                'isi' => 'Kegiatan Penyerahan Penghargaan kepada Seluruh Anggota Tim PMR SMK Negeri 4 Bogor yang telah meraih: Juara Umum, Pertolongan Pertama Putri (Juara Harapan 1), Tandu Putri Regu (Juara 2), Tandu Putra Regu (Juara 1), dan Perawatan Keluarga (Juara 2). Penyerahan Penghargaan ini dilaksanakan di lapangan SMK Negeri 4 Bogor pada hari Senin, 17 November 2025.',
                'tanggal' => '2025-11-17',
                'gambar' => 'berita-1.jpeg',
            ],
            [
                'slug' => 'tim-pmr-juara-4',
                'kategori' => 'Prestasi',
                'judul' => 'Tim PMR SMKN 4 Bogor meraih berbagai juara',
                'isi' => 'Kegiatan Penyerahan Penghargaan kepada Seluruh Anggota Tim PMR SMK Negeri 4 Bogor yang telah meraih prestasi membanggakan di tingkat kota.',
                'tanggal' => '2025-11-15',
                'gambar' => 'berita-2.jpeg',
            ],
            [
                'slug' => 'tim-pmr-juara-5',
                'kategori' => 'Prestasi',
                'judul' => 'Tim PMR SMKN 4 Bogor meraih berbagai juara',
                'isi' => 'Kegiatan Penyerahan Penghargaan kepada Seluruh Anggota Tim PMR SMK Negeri 4 Bogor yang telah meraih prestasi membanggakan di tingkat provinsi.',
                'tanggal' => '2025-11-14',
                'gambar' => 'berita-1.jpeg',
            ],
            [
                'slug' => 'kegiatan-upacara-senin',
                'kategori' => 'Kegiatan',
                'judul' => 'Upacara Bendera Hari Senin SMKN 4 Bogor',
                'isi' => 'Kegiatan rutin upacara bendera hari Senin diikuti oleh seluruh siswa dan guru SMKN 4 Bogor sebagai bentuk penanaman nilai disiplin dan cinta tanah air. Upacara berjalan dengan tertib dan khidmat.',
                'tanggal' => '2025-11-17',
                'gambar' => 'berita-1.jpeg',
            ],
            [
                'slug' => 'kegiatan-lomba-miraj',
                'kategori' => 'Kegiatan',
                'judul' => 'Lomba Miraj Inspire Fest & Tarhib Ramadhan',
                'isi' => 'Rangkaian kegiatan menyambut bulan suci Ramadhan yang diikuti oleh seluruh siswa SMKN 4 Bogor, meliputi lomba-lomba islami dan pawai tarhib Ramadhan di lingkungan sekolah.',
                'tanggal' => '2025-11-10',
                'gambar' => 'berita-2.jpeg',
            ],
            [
                'slug' => 'kegiatan-neospragma',
                'kategori' => 'Kegiatan',
                'judul' => 'Penyuluhan & Bimbingan Jabatan SMKN 4 Bogor',
                'isi' => 'Kegiatan penyuluhan dan bimbingan jabatan untuk mempersiapkan siswa menghadapi dunia kerja, bekerja sama dengan mitra industri dan alumni SMKN 4 Bogor.',
                'tanggal' => '2025-11-12',
                'gambar' => 'berita-1.jpeg',
            ],
            [
                'slug' => 'kegiatan-praktik-industri',
                'kategori' => 'Kegiatan',
                'judul' => 'Kunjungan Industri Siswa SMKN 4 Bogor',
                'isi' => 'Siswa SMKN 4 Bogor melakukan kunjungan ke berbagai perusahaan mitra untuk menambah wawasan dunia kerja dan mempersiapkan diri menghadapi Praktik Kerja Lapangan (PKL).',
                'tanggal' => '2025-11-09',
                'gambar' => 'berita-2.jpeg',
            ],
            [
                'slug' => 'kegiatan-ekstrakurikuler',
                'kategori' => 'Kegiatan',
                'judul' => 'Pekan Ekstrakurikuler SMKN 4 Bogor',
                'isi' => 'Rangkaian kegiatan pekan ekstrakurikuler untuk mengembangkan bakat dan minat siswa di luar akademik, meliputi olahraga, seni, dan kegiatan sosial.',
                'tanggal' => '2025-11-07',
                'gambar' => 'berita-1.jpeg',
            ],
            [
                'slug' => 'berita-sertifikasi-toeic',
                'kategori' => 'Berita',
                'judul' => 'Program Sertifikasi Bahasa Inggris (TOEIC)',
                'isi' => 'SMKN 4 Bogor mengadakan program sertifikasi TOEIC untuk meningkatkan kompetensi bahasa Inggris siswa sebagai bekal menghadapi dunia kerja dan industri yang semakin global.',
                'tanggal' => '2025-11-05',
                'gambar' => 'berita-1.jpeg',
            ],
            [
                'slug' => 'berita-kelulusan-jalur-mbkm',
                'kategori' => 'Berita',
                'judul' => 'Selamat & Sukses Kepada Siswa yang Lolos Seleksi',
                'isi' => 'Ucapan selamat kepada siswa-siswi yang telah lolos seleksi perguruan tinggi negeri melalui jalur MBKM, menjadi kebanggaan bagi sekolah dan motivasi bagi siswa lainnya.',
                'tanggal' => '2025-11-01',
                'gambar' => 'berita-2.jpeg',
            ],
            [
                'slug' => 'berita-lomba-miraj-fest',
                'kategori' => 'Berita',
                'judul' => 'Lomba Miraj Inspire Fest & Tarhib Ramadhan',
                'isi' => 'Rangkaian kegiatan menyambut bulan suci Ramadhan yang diikuti oleh seluruh siswa SMKN 4 Bogor, meliputi lomba-lomba islami dan pawai tarhib Ramadhan di lingkungan sekolah.',
                'tanggal' => '2025-11-08',
                'gambar' => 'berita-2.jpeg',
            ],
            [
                'slug' => 'berita-penerimaan-siswa-baru',
                'kategori' => 'Berita',
                'judul' => 'Informasi Penerimaan Peserta Didik Baru (PPDB)',
                'isi' => 'SMKN 4 Bogor membuka pendaftaran peserta didik baru untuk tahun ajaran mendatang, dengan berbagai jalur pendaftaran yang tersedia bagi calon siswa.',
                'tanggal' => '2025-11-03',
                'gambar' => 'berita-2.jpeg',
            ],
            [
                'slug' => 'berita-workshop-guru',
                'kategori' => 'Berita',
                'judul' => 'Workshop Peningkatan Kompetensi Guru',
                'isi' => 'SMKN 4 Bogor mengadakan workshop untuk meningkatkan kompetensi dan kualitas pengajaran para guru, sejalan dengan perkembangan kurikulum dan teknologi terkini.',
                'tanggal' => '2025-11-02',
                'gambar' => 'berita-1.jpeg',
            ],
        ];

        foreach ($items as $item) {
            Informasi::create([
                'judul'    => $item['judul'],
                'slug'     => $item['slug'],
                'isi'      => $item['isi'],
                'gambar'   => $item['gambar'],
                'tanggal'  => $item['tanggal'],
                'kategori' => $item['kategori'],
                'status'   => 'Publik',
            ]);
        }
    }
}