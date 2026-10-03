<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\Galeri;
use App\Models\Jurusan;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            ['label' => 'Informasi', 'sub' => 'Total Informasi Terbaru', 'value' => Informasi::count(), 'icon' => 'informasi'],
            ['label' => 'Galeri', 'sub' => 'Total Foto Terbaru', 'value' => Galeri::count(), 'icon' => 'galeri'],
            ['label' => 'Jurusan', 'sub' => 'Total Jurusan', 'value' => Jurusan::count(), 'icon' => 'jurusan'],
            ['label' => 'Produk', 'sub' => 'Total Produk Terbaru', 'value' => Produk::count(), 'icon' => 'produk'],
        ];

        $beritaTerbaru = Informasi::orderByDesc('created_at')
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'gambar'   => $item->gambar,
                    'judul'    => $item->judul,
                    'tanggal'  => $item->tanggal->format('d-m-Y'),
                    'kategori' => $item->kategori,
                    'status'   => $item->status,
                ];
            });

        $produkList = Produk::orderByDesc('created_at')
            ->take(4)
            ->get()
            ->map(function ($p) {
                return [
                    'label'      => 'Produk',
                    'teks'       => $p->nama,
                    'created_at' => $p->created_at,
                ];
            });

        $galeriList = Galeri::orderByDesc('created_at')
            ->take(4)
            ->get()
            ->map(function ($g) {
                return [
                    'label'      => 'Galeri',
                    'teks'       => $g->judul,
                    'created_at' => $g->created_at,
                ];
            });

        $produkGaleriTerbaru = $produkList->concat($galeriList)
            ->sortByDesc('created_at')
            ->take(4)
            ->map(fn ($item) => "[{$item['label']}] {$item['teks']}");

        return view('admin.dashboard', compact('stats', 'beritaTerbaru', 'produkGaleriTerbaru'));
    }
}