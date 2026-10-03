<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        Jurusan::create([
            'kode'      => 'PPLG',
            'nama'      => 'Pengembangan Perangkat Lunak dan Gim',
            'deskripsi' => 'Pengembangan Perangkat Lunak dan Gim (PPLG) adalah program keahlian yang dirancang untuk mencetak talenta di bidang teknologi digital. Selama belajar, siswa akan mempelajari berbagai kompetensi seperti pemrograman, pengembangan website, aplikasi mobile, basis data, UI/UX, hingga pengembangan gim. Didukung oleh pembelajaran berbasis praktik dan proyek nyata, siswa akan memperoleh pengalaman yang relevan dengan kebutuhan industri sehingga siap menghadapi dunia kerja maupun melanjutkan pendidikan di bidang teknologi.',
            'logo'      => 'icon-pplg.png',
            'foto_kegiatan'  => 'jurusan-pplg.png',
            'prestasi'       => [
                'Juara 1 LKS Tingkat Kota Bogor (2025/2026): Diraih oleh Novandra Aria Budi Raspati pada bidang keahlian Cloud Computing.',
                'Juara 3 LKS Tingkat Kota Bidang Web Technology (2026): Diraih oleh Justine (Kelas XI PPLG 2).',
                'Juara 2 Web Design Competition IBI Kesatuan: Diraih oleh Akbar Tolib Ramadan dan Muhammad Fachru Buchori (Kelas XII PPLG 2).',
            ],
            'prospek_karier' => [
                'Programmer',
                'Web Developer',
                'Mobile Developer',
                'Game Developer',
                'IT Support',
                'Database Administrator',
                'Wirausaha di Bidang Digital',
                'Melanjutkan Pendidikan',
            ],
        ]);

        Jurusan::create([
            'kode'      => 'TPFL',
            'nama'      => 'Teknik Pengelasan Fabrikasi Logam',
            'deskripsi' => 'Teknik Pengelasan dan Fabrikasi Logam (TPFL) merupakan program keahlian yang membekali siswa dengan pengetahuan dan keterampilan di bidang pengelasan, pembentukan, serta fabrikasi logam sesuai standar industri. Siswa akan mempelajari berbagai teknik pengelasan, membaca gambar teknik, mengoperasikan peralatan fabrikasi, hingga menerapkan keselamatan dan kesehatan kerja (K3). Melalui pembelajaran berbasis praktik dan kerja sama dengan dunia industri, lulusan TPFL dipersiapkan menjadi tenaga kerja yang kompeten, profesional, dan siap bersaing di dunia kerja maupun melanjutkan pendidikan.',
            'logo'      => 'icon-tpfl.png',
            'foto_kegiatan'  => 'jurusan-tpfl.png',
            'prestasi'       => [
                'Juara 1 LKS Tingkat Kota Bidang Welding (Mei 2026): Diraih oleh Akbar (siswa kelas XII TPFL 2).',
                'Juara 1 LKS Teknik Pengelasan: Diraih oleh Muhammad Destian.',
                'Juara 2 LKS CAD Tingkat Kota Bogor: Diraih oleh Arvhio Arviansyah.',
            ],
            'prospek_karier' => [
                'Welder (Juru Las)',
                'Teknisi Fabrikasi Logam',
                'Teknisi Konstruksi Baja',
                'Operator Mesin Fabrikasi',
                'Quality Control (QC)',
                'Teknisi Industri Manufaktur',
                'Wirausaha di Bidang Pengelasan',
                'Melanjutkan Pendidikan',
            ],
        ]);

        Jurusan::create([
            'kode'      => 'TO',
            'nama'      => 'Teknik Otomotif',
            'deskripsi' => 'Teknik Otomotif (TO) merupakan program keahlian yang membekali siswa dengan pengetahuan dan keterampilan di bidang perawatan, perbaikan, serta diagnosis kendaraan bermotor. Melalui pembelajaran berbasis praktik di bengkel dan kerja sama dengan dunia industri, siswa mempelajari sistem mesin, kelistrikan, chassis, hingga teknologi otomotif modern. Program ini dirancang untuk menghasilkan lulusan yang kompeten, disiplin, dan siap menghadapi perkembangan industri otomotif.',
            'logo'      => 'icon-to.png',
            'foto_kegiatan'  => 'jurusan-to.png',
            'prestasi'       => [
                'Juara 1 LKS Teknik Otomotif Kota Bogor: Diraih oleh Muhamad Agung Hidayat dalam ajang LKS tingkat kota.',
                'Prestasi LKS Tingkat Kota Lainnya: Jurusan Teknik Otomotif di SMKN 4 Bogor secara rutin aktif berpartisipasi dan mencetak prestasi pada ajang kebolehan teknik dan rekayasa, seperti bidang pendukung otomotif dan CAD.',
            ],
            'prospek_karier' => [
                'Teknisi Kendaraan',
                'Mekanik Bengkel',
                'Teknisi Kelistrikan',
                'Service Advisor',
                'Quality Control',
                'Operator Industri Otomotif',
                'Wirausaha Bengkel',
                'Melanjutkan Pendidikan',
            ],
        ]);

        Jurusan::create([
            'kode'      => 'TJKT',
            'nama'      => 'Teknik Jaringan Komputer dan Telekomunikasi',
            'deskripsi' => 'Teknik Jaringan Komputer dan Telekomunikasi (TJKT) merupakan program keahlian yang membekali siswa dengan pengetahuan dan keterampilan di bidang jaringan komputer, sistem telekomunikasi, serta teknologi informasi. Siswa akan mempelajari instalasi, konfigurasi, pemeliharaan, dan pengelolaan jaringan komputer, server, serta perangkat telekomunikasi sesuai standar industri. Melalui pembelajaran berbasis praktik dan kerja sama dengan dunia usaha dan industri, lulusan TJKT dipersiapkan menjadi tenaga profesional yang kompeten, adaptif, dan siap menghadapi perkembangan teknologi digital.',
            'logo'      => 'icon-tjkt.png',
            'foto_kegiatan'  => 'jurusan-tjkt.png',
            'prestasi'       => [
                'Juara 1 LKS (Lomba Kompetensi Siswa) Tingkat Kota Bogor 2026 bidang keahlian Network Cabling diraih oleh Fadilah (XI TJKT 1).',
                'Juara 1 LKS Tingkat Kota Bogor 2025 bidang keahlian Information Network Cabling diraih oleh Muhammad Harist Abdullah Arrohman.',
                'Juara 3 LKS Tingkat Kota Bogor 2025 bidang keahlian Cyber Security diraih oleh Bagas Refani Putra dan Muhammad Heidar.',
            ],
            'prospek_karier' => [
                'Network Engineer',
                'IT Support',
                'Network Technician',
                'Teknisi Telekomunikasi',
                'System Administrator',
                'Network Security',
                'Wirausaha di Bidang Teknologi',
                'Melanjutkan Pendidikan',
            ],
        ]);
    }
}