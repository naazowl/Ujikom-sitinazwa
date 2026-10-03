<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Support\Str;

class JurusanController extends Controller
{
    private function mapItem($j): array
    {
        return [
            'kode'              => $j->kode,
            'nama'              => $j->nama,
            'deskripsi_singkat' => Str::limit($j->deskripsi, 100),
            'deskripsi_lengkap' => $j->deskripsi,
            'foto'              => $j->foto_kegiatan ? 'jurusan/kegiatan/' . $j->foto_kegiatan : 'no-image.png',
            'icon'              => $j->logo ? 'jurusan/logo/' . $j->logo : 'no-image.png',
            'prestasi'          => $j->prestasi ?? [],
            'prospek'           => $j->prospek_karier ?? [],
        ];
    }

    public function index()
    {
        $jurusanList = Jurusan::orderBy('kode')
            ->get()
            ->map(fn ($j) => $this->mapItem($j))
            ->values()
            ->all();

        return view('jurusan.index', [
            'jurusanList' => $jurusanList,
        ]);
    }

    public function show($kode)
    {
        $item = Jurusan::whereRaw('UPPER(kode) = ?', [strtoupper($kode)])->first();

        abort_if(!$item, 404);

        return view('jurusan.show', [
            'item' => $this->mapItem($item),
        ]);
    }
}