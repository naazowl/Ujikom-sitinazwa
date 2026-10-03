<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Jurusan;
use Carbon\Carbon;

class HomeController extends Controller
{
    private function formatTanggal($tanggal): string
    {
        $bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        $c = Carbon::parse($tanggal);

        return $c->day . ' ' . $bulan[$c->month] . ' ' . $c->year;
    }

    public function index()
    {
        $stats = [
            ['icon' => 'siswa', 'value' => '1.160+', 'label' => 'Siswa aktif'],
            ['icon' => 'guru', 'value' => '80', 'label' => 'Guru & Staf'],
            ['icon' => 'jurusan', 'value' => (string) Jurusan::count(), 'label' => 'Jurusan'],
        ];

        $beritaTerbaru = Informasi::where('status', 'Publik')
            ->orderByDesc('tanggal')
            ->take(4)
            ->get()
            ->map(function ($item) {
                return [
                    'slug'      => $item->slug,
                    'kategori'  => $item->kategori,
                    'judul'     => $item->judul,
                    'deskripsi' => \Illuminate\Support\Str::limit(strip_tags($item->isi), 120),
                    'tanggal'   => $this->formatTanggal($item->tanggal),
                    'gambar'    => $item->gambar ? 'informasi/' . $item->gambar : 'no-image.png',
                ];
            })
            ->values()
            ->all();

        $jurusanUnggulan = Jurusan::orderBy('kode')
            ->get()
            ->map(fn ($j) => [
                'kode' => $j->kode,
                'nama' => $j->nama,
                'icon' => strtolower($j->kode),
            ])
            ->values()
            ->all();

        return view('home', compact('stats', 'beritaTerbaru', 'jurusanUnggulan'));
    }
}