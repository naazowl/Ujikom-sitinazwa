<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Jurusan;
use Carbon\Carbon;

class ProdukController extends Controller
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
        'slug'              => $item->slug,
        'kategori'          => $item->kategori,
        'kategori_produk'   => $item->kategori_produk,
        'nama'              => $item->nama,
        'deskripsi_singkat' => \Illuminate\Support\Str::limit($item->deskripsi_lengkap, 120),
        'deskripsi_lengkap' => $item->deskripsi_lengkap,
        'gambar'            => $item->gambar ? 'produk/' . $item->gambar : 'no-image.png',
        'tanggal'           => $this->formatTanggal($item->tanggal),
    ];
}

    public function index(Request $request)
    {
        $keyword = $request->query('q');

        $query = Produk::query();

        if ($keyword) {
            $query->where('nama', 'like', "%{$keyword}%");
        }

        $semua = $query->orderByDesc('tanggal')->get();

        $kodeJurusan = Jurusan::orderBy('kode')->pluck('kode');

        $grouped = [];

        foreach ($kodeJurusan as $kode) {
            $grouped[$kode] = $semua->where('kategori', $kode)
                ->map(fn ($i) => $this->mapItem($i))
                ->values()
                ->all();
        }

        return view('produk.index', [
            'grouped' => $grouped,
            'keyword' => $keyword,
        ]);
    }

    public function kategori($kategori)
    {
        $label = strtoupper($kategori);

        $items = Produk::where('kategori', $label)
            ->orderByDesc('tanggal')
            ->get()
            ->map(fn ($i) => $this->mapItem($i))
            ->values()
            ->all();

        return view('produk.kategori', [
            'items'         => $items,
            'kategoriLabel' => $label,
        ]);
    }

    public function show($slug)
    {
        $item = Produk::where('slug', $slug)->first();

        abort_if(!$item, 404);

        return view('produk.show', [
            'item' => $this->mapItem($item),
        ]);
    }
}