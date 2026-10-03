@extends('layouts.admin')

@section('title', 'Dashboard - Admin Portal')

@section('content')

@php
    $rute = function ($nama, $fallback) {
        return \Illuminate\Support\Facades\Route::has($nama) ? route($nama) : route($fallback);
    };

    $tujuanStat = [
        'informasi' => route('admin.informasi.index'),
        'galeri'    => route('admin.galeri.index'),
        'jurusan'   => route('admin.jurusan.index'),
        'produk'    => route('admin.produk.index'),
    ];

    $nilaiStat = collect($stats)->map(fn ($s) => (int) preg_replace('/\D/', '', (string) $s['value']));

    $belumDibaca = \App\Models\Pesan::where('sudah_dibaca', false)->count();
@endphp

<div class="admin-stats-grid">
    @foreach ($stats as $stat)
        @php
            $jenis = in_array($stat['icon'], ['informasi', 'galeri', 'jurusan']) ? $stat['icon'] : 'produk';
        @endphp

        <a href="{{ $tujuanStat[$jenis] }}" class="admin-stat-card admin-stat-{{ $jenis }}">

            <svg class="admin-stat-go" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/>
            </svg>

            <div class="admin-stat-top">

                <div class="admin-stat-icon">
                    @if ($jenis === 'informasi')
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="16" x2="12" y2="12"/>
                            <line x1="12" y1="8" x2="12.01" y2="8"/>
                        </svg>
                    @elseif ($jenis === 'galeri')
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                    @elseif ($jenis === 'jurusan')
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"/>
                            <circle cx="20" cy="21" r="1"/>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                        </svg>
                    @endif
                </div>

                <div class="admin-stat-text">
                    <h4>{{ $stat['sub'] }}</h4>
                </div>

            </div>

            <div class="admin-stat-bottom">
                <div class="admin-stat-value" data-count="{{ $nilaiStat[$loop->index] }}">{{ $stat['value'] }}</div>
            </div>

        </a>
    @endforeach
</div>


<div class="admin-panel">
    <div class="admin-panel-head">
        <h2 class="admin-panel-title">Aksi Cepat</h2>
    </div>

    <div class="admin-quick">

        <a href="{{ $rute('admin.informasi.create', 'admin.informasi.index') }}" class="admin-quick-item admin-stat-informasi">
            <span class="admin-quick-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </span>
            <span class="admin-quick-text">Tambah Informasi</span>
        </a>

        <a href="{{ $rute('admin.galeri.create', 'admin.galeri.index') }}" class="admin-quick-item admin-stat-galeri">
            <span class="admin-quick-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </span>
            <span class="admin-quick-text">Upload Foto</span>
        </a>

        <a href="{{ $rute('admin.produk.create', 'admin.produk.index') }}" class="admin-quick-item admin-stat-produk">
            <span class="admin-quick-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </span>
            <span class="admin-quick-text">Tambah Produk</span>
        </a>

        <a href="{{ route('admin.pesan.index') }}" class="admin-quick-item admin-stat-jurusan">
            <span class="admin-quick-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </span>
            <span class="admin-quick-text">
                Buka Pesan
                @if ($belumDibaca > 0)
                    <em>{{ $belumDibaca }} baru</em>
                @endif
            </span>
        </a>

    </div>
</div>

<h2 class="admin-section-title">Konten Berita &amp; Pengumuman Terbaru</h2>

<div class="admin-table-wrap" id="dashboardBeritaTable">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Judul Artikel</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($beritaTerbaru as $berita)
                <tr>
                    <td>
                        <img
                            src="{{ $berita['gambar'] ? asset('images/informasi/'.$berita['gambar']) : asset('images/no-image.png') }}"
                            alt=""
                            class="admin-thumb"
                        >
                    </td>

                    <td>{{ $berita['judul'] }}</td>

                    <td>{{ $berita['tanggal'] }}</td>

                    <td>
                        <span class="admin-badge admin-badge-{{ strtolower($berita['kategori']) }}">
                            {{ $berita['kategori'] }}
                        </span>
                    </td>

                    <td>{{ $berita['status'] }}</td>
                </tr>
            @empty
                <tr class="admin-empty-row">
                    <td colspan="5">Belum ada berita.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<h2 class="admin-section-title">Produk &amp; Galeri Terbaru</h2>

@if (count($produkGaleriTerbaru) > 0)
    <div class="admin-recent-grid">
        @foreach ($produkGaleriTerbaru as $item)
            @php
                $tipe = 'produk';
                $nama = is_string($item) ? $item : '';

                if (is_array($item)) {
                    $nama = $item['nama'] ?? $item['judul'] ?? '';
                    $tipe = strtolower($item['tipe'] ?? 'produk');
                } elseif (preg_match('/^\[(.+?)\]\s*(.+)$/u', $item, $m)) {
                    $tipe = strtolower(trim($m[1]));
                    $nama = $m[2];
                }

                $tipe = $tipe === 'galeri' ? 'galeri' : 'produk';
                $tujuan = $tipe === 'galeri' ? route('admin.galeri.index') : route('admin.produk.index');
            @endphp

            <a href="{{ $tujuan }}" class="admin-recent-card">

                <div class="admin-recent-icon">
                    @if ($tipe === 'galeri')
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"/>
                            <circle cx="20" cy="21" r="1"/>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                        </svg>
                    @endif
                </div>

                <div class="admin-recent-body">
                    <span class="admin-recent-tag">{{ $tipe === 'galeri' ? 'Galeri' : 'Produk' }}</span>
                    <p class="admin-recent-name" title="{{ $nama }}">{{ $nama }}</p>
                </div>

                <svg class="admin-recent-arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>

            </a>
        @endforeach
    </div>
@else
    <div class="admin-recent-empty">
        <div class="admin-recent-empty-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                <line x1="12" y1="22.08" x2="12" y2="12"/>
            </svg>
        </div>
        <p>Belum ada produk atau foto galeri.</p>
    </div>
@endif

@endsection

@push('scripts')
<script>
    (function () {
        var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (reduce) return;

        document.querySelectorAll('.admin-stat-value[data-count]').forEach(function (el) {
            var target = parseInt(el.dataset.count, 10);
            var original = el.textContent.trim();
            if (!isFinite(target) || target <= 0) return;

            var start = null, duration = 1100;
            el.textContent = '0';

            function frame(ts) {
                if (start === null) start = ts;
                var p = Math.min((ts - start) / duration, 1);
                var eased = 1 - Math.pow(1 - p, 3);
                el.textContent = Math.round(target * eased);
                if (p < 1) requestAnimationFrame(frame);
                else el.textContent = original;
            }

            setTimeout(function () { requestAnimationFrame(frame); }, 250);
        });
    })();
</script>
@endpush