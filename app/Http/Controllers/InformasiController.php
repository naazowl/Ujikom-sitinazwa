<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\Galeri;
use Carbon\Carbon;

class InformasiController extends Controller
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

    private function mapItem($item): array
    {
        return [
            'slug'      => $item->slug,
            'kategori'  => $item->kategori,
            'judul'     => $item->judul,
            'ringkasan' => \Illuminate\Support\Str::limit(strip_tags($item->isi), 120),
            'isi'       => $item->isi,
            'hashtag'   => '',
            'tanggal'   => $this->formatTanggal($item->tanggal),
            'author'    => 'Admin',
            'gambar'    => $item->gambar ? 'informasi/' . $item->gambar : 'no-image.png',
        ];
    }

    private function galeriData()
    {
        return Galeri::where('status', 'Publik')
            ->orderByDesc('tanggal')
            ->get()
            ->map(fn ($g) => [
                'id'         => $g->id,
                'judul'      => $g->judul,
                'keterangan' => $g->keterangan,
                'gambar'     => $g->gambar ? 'galeri/' . $g->gambar : 'no-image.png',
            ])
            ->values()
            ->all();
    }

    public function index(Request $request)
    {
        $keyword = $request->query('q');

        $query = Informasi::where('status', 'Publik');

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('isi', 'like', "%{$keyword}%");
            });
        }

        $semua = $query->orderByDesc('tanggal')->get();

        $prestasi = $semua->where('kategori', 'Prestasi')->map(fn ($i) => $this->mapItem($i))->values()->all();
        $kegiatan = $semua->where('kategori', 'Kegiatan')->map(fn ($i) => $this->mapItem($i))->values()->all();
        $berita   = $semua->where('kategori', 'Berita')->map(fn ($i) => $this->mapItem($i))->values()->all();

        return view('informasi.index', [
            'prestasi' => $prestasi,
            'kegiatan' => $kegiatan,
            'berita'   => $berita,
            'keyword'  => $keyword,
            'galeri'   => $this->galeriData(),
        ]);
    }

    public function semua()
    {
        $items = Informasi::where('status', 'Publik')
            ->orderByDesc('tanggal')
            ->get()
            ->map(fn ($i) => $this->mapItem($i))
            ->values()
            ->all();

        return view('informasi.semua', [
            'items' => $items,
        ]);
    }

    public function kategori($kategori)
    {
        $label = ucfirst($kategori);

        $items = Informasi::where('status', 'Publik')
            ->whereRaw('LOWER(kategori) = ?', [strtolower($kategori)])
            ->orderByDesc('tanggal')
            ->get()
            ->map(fn ($i) => $this->mapItem($i))
            ->values()
            ->all();

        return view('informasi.kategori', [
            'items'         => $items,
            'kategoriLabel' => $label,
        ]);
    }

    public function show($slug)
    {
        $item = Informasi::where('status', 'Publik')
            ->where('slug', $slug)
            ->first();

        abort_if(!$item, 404);

        return view('informasi.show', [
            'item' => $this->mapItem($item),
        ]);
    }
}