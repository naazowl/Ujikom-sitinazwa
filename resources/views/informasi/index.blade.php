@extends('layouts.app')

@section('title', 'Informasi Umum - SMKN 4 Bogor')

@section('content')

<section class="page-hero informasi-hero">
    <img src="{{ asset('images/page-hero-bg.png') }}" alt="SMKN 4 Bogor" class="page-hero-bg">
    <div class="page-hero-content">
        <h1>Informasi Terbaru &amp; <span class="hero-accent">Galeri</span></h1>
        <p>Informasi terkini &amp; galeri mengenai kegiatan serta prestasi di SMKN 4 Bogor</p>
    </div>
</section>

<div class="search-bar-wrap">
    <form action="{{ url('/informasi') }}" method="GET" class="search-bar">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" name="q" placeholder="Cari informasi kegiatan..." value="{{ $keyword }}">
    </form>
</div>

<div class="informasi-wrap">

    <h2 class="informasi-heading">Informasi terbaru</h2>

    @foreach ([['Prestasi', $prestasi], ['Kegiatan', $kegiatan], ['Berita', $berita]] as [$label, $items])
        <div class="kategori-section">
            <div class="kategori-header">
                <a href="{{ url('/informasi/kategori/'.strtolower($label)) }}" class="kategori-badge">{{ $label }}</a>
                @if (count($items) > 0)
                    <a href="{{ url('/informasi/semua') }}" class="btn-outline-small">Lihat Semua &rarr;</a>
                @endif
            </div>

            @if (count($items) === 0)
                <p class="empty-text">Belum ada informasi pada kategori ini.</p>
            @else
                <div class="informasi-scroll-wrap">
                    <div class="informasi-track">
                        @foreach ($items as $item)
                            <a href="{{ url('/informasi/'.$item['slug']) }}" class="informasi-card">
                                <div class="informasi-img-wrap">
                                    <img src="{{ asset('images/'.$item['gambar']) }}" alt="{{ $item['judul'] }}">
                                </div>
                                <div class="informasi-body">
                                    <h4>{{ $item['judul'] }}</h4>
                                    <p>{{ $item['ringkasan'] }}</p>
                                    <div class="informasi-footer">
                                        <span class="informasi-date">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                                            </svg>
                                            {{ $item['tanggal'] }}
                                        </span>
                                        <span class="informasi-author">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                                            </svg>
                                            {{ $item['author'] }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endforeach

    {{-- GALERI --}}
    <div class="kategori-section">
        <div class="kategori-header kategori-header-center">
            <span class="line"></span>
            <h2>Galeri</h2>
            <span class="line"></span>
        </div>

        <div class="galeri-grid">
            @foreach ($galeri as $foto)
                <div class="galeri-item"
                     data-galeri-id="{{ $foto['id'] }}"
                     data-src="{{ asset('images/'.$foto['gambar']) }}"
                     data-judul="{{ $foto['judul'] }}"
                     data-keterangan="{{ $foto['keterangan'] }}"
                     onclick="bukaGaleriModal(this)">
                    <img src="{{ asset('images/'.$foto['gambar']) }}" alt="{{ $foto['judul'] }}" loading="lazy">

                    <button type="button" class="galeri-like-btn" aria-label="Suka foto ini">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                        </svg>
                        <span class="galeri-like-count">0</span>
                    </button>
                </div>
            @endforeach
        </div>
    </div>

</div>


<div id="galeriModal" class="galeri-modal" onclick="if (event.target === this) tutupGaleriModal()">
    <button type="button" class="galeri-modal-close" onclick="tutupGaleriModal()" aria-label="Tutup">&times;</button>

    <div class="galeri-card">
        <div class="galeri-card-media">
            <img id="galeriModalImg" src="" alt="">
        </div>

        <div class="galeri-card-info">
            <span class="galeri-card-label">Galeri SMKN 4 Bogor</span>
            <h3 id="galeriModalCaption" class="galeri-card-title"></h3>
            <span class="galeri-card-bar"></span>
            <p id="galeriModalDesc" class="galeri-card-desc"></p>

            <div class="galeri-card-actions">
                <button type="button" id="galeriModalLike" class="galeri-like-btn galeri-like-btn-modal" aria-label="Suka foto ini">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                    <span class="galeri-like-count">0</span>
                </button>

                <a id="galeriModalDownload" class="galeri-download-btn" href="#" download>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                    Unduh Foto
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function bukaGaleriModal(el) {
        var d = el.dataset;

        document.getElementById('galeriModalImg').src = d.src;
        document.getElementById('galeriModalCaption').textContent = d.judul;
        document.getElementById('galeriModalDesc').textContent = d.keterangan || '';

        var ext = (d.src.split('?')[0].split('.').pop() || 'jpg').toLowerCase();
        var nama = (d.judul || 'foto-galeri')
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '') || 'foto-galeri';

        var unduh = document.getElementById('galeriModalDownload');
        unduh.href = d.src;
        unduh.setAttribute('download', nama + '.' + ext);

        document.getElementById('galeriModal').classList.add('is-open');
        document.body.style.overflow = 'hidden';

        if (window.galeriLikeOpen) window.galeriLikeOpen(d.galeriId);
    }

    function tutupGaleriModal() {
        document.getElementById('galeriModal').classList.remove('is-open');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') tutupGaleriModal();
    });
</script>

<script>
    window.GALERI_LIKE = {
        listUrl: "{{ route('galeri.likes') }}",
        toggleUrl: "{{ url('/galeri') }}/",
        csrf: "{{ csrf_token() }}"
    };
</script>
<script src="{{ asset('js/galeri-like.js') }}"></script>

<script src="{{ asset('js/animasi-klik.js') }}"></script>
<script src="{{ asset('js/animasi-muncul.js') }}"></script>

@endsection