@extends('layouts.app')

@section('title', 'Beranda - SMKN 4 Bogor')

@section('content')

{{-- HERO SECTION --}}
<section class="hero">
    <div class="hero-overlay"></div>
    <img src="{{ asset('images/hero-lapangan.jpg') }}" alt="Lapangan SMKN 4 Bogor" class="hero-bg">
    <div class="hero-content">
        <p class="hero-label">SELAMAT DATANG DI WEBSITE RESMI</p>
        <h1 class="hero-title">SMKN 4 KOTA BOGOR</h1>
        <p class="hero-desc">
            Mewujudkan generasi unggul, berkarakter, dan kompeten di bidang teknologi dan kejuruan.
            Siap kerja, santun, mandiri, dan kreatif.
        </p>
        <div class="hero-buttons">
            <a href="#tentang-section" class="btn btn-primary">Tentang kami</a>
            <a href="#informasi-terbaru" class="btn btn-outline">Berita Terbaru</a>
        </div>
    </div>
</section>

{{-- SAMBUTAN KEPALA SEKOLAH --}}
<section class="sambutan">
    <div class="sambutan-container">
        <span class="sambutan-blob sambutan-blob-2"></span>

        <div class="sambutan-img-wrap">
            <img src="{{ asset('images/kepsek.png') }}" alt="Kepala Sekolah" class="sambutan-img">
        </div>

        <div class="sambutan-text">
            <span class="sambutan-blob sambutan-blob-1"></span>

            <h2>Sambutan<br>Kepala Sekolah</h2>
            <p>
                Selamat datang di website resmi SMKN 4 Kota Bogor. Website ini menjadi media informasi
                bagi siswa, orang tua, alumni, dan masyarakat untuk mengenal lebih dekat sekolah kami.
            </p>
            <p>
                Semoga website ini dapat memberikan informasi yang bermanfaat serta menjadi jembatan
                komunikasi antara sekolah dan masyarakat. Terima kasih atas kunjungan Anda.
            </p>
        </div>
    </div>
</section>

{{-- TENTANG + VISI MISI --}}
<section class="tentang" id="tentang-section">
    <div class="tentang-card">
        <h2>Tentang SMKN 4 Kota Bogor</h2>
        <p>
            SMKN 4 Kota Bogor merupakan sekolah menengah kejuruan yang berkomitmen mencetak lulusan
            yang kompeten, berkarakter, kreatif, dan siap menghadapi dunia kerja maupun melanjutkan pendidikan.
        </p>

        <div class="visi-misi-grid">
            <div class="visi-misi-box">
                <h3>Visi</h3>
                <p>Menjadi sekolah menengah kejuruan yang inovatif, berprestasi, dan menghasilkan lulusan yang unggul, berkarakter, serta siap bersaing di era global.</p>
            </div>
            <div class="visi-misi-box">
                <h3>Misi</h3>
                <p>Menyelenggarakan pendidikan yang berkualitas dengan mengembangkan karakter, kompetensi, kreativitas, dan kemandirian peserta didik, serta menjalin kerja sama dengan dunia usaha dan dunia industri untuk menghasilkan lulusan yang siap menghadapi tantangan masa depan.</p>
            </div>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="stats-grid">
        @foreach ($stats as $stat)
            <div class="stat-card">
                <div class="stat-icon">
                    @if ($stat['icon'] === 'siswa')
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    @elseif ($stat['icon'] === 'guru')
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/><path d="M12 11l3-3"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
                        </svg>
                    @endif
                </div>
                <div class="stat-value">{{ $stat['value'] }}</div>
                <div class="stat-label">{{ $stat['label'] }}</div>
            </div>
        @endforeach
    </div>
</section>

{{-- INFORMASI TERBARU --}}
<section class="informasi-terbaru" id="informasi-terbaru">
    <div class="section-header">
        <div>
            <h2>Informasi terbaru</h2>
            <p>Update Terkini Kegiatan Di Sekolah &amp; Galeri</p>
        </div>
        <a href="{{ url('/informasi') }}" class="btn-outline-small">Lihat Semua &rarr;</a>
    </div>

    <div class="berita-scroll-wrap">
        <div class="berita-grid">
            @foreach ($beritaTerbaru as $berita)
                <a href="{{ url('/informasi/'.$berita['slug']) }}" class="berita-card" style="text-decoration: none; color: inherit; display: block;">
                    <div class="berita-img-wrap">
                        <img src="{{ asset('images/'.$berita['gambar']) }}" alt="{{ $berita['judul'] }}">
                        <span class="berita-badge">{{ $berita['kategori'] }}</span>
                    </div>
                    <div class="berita-body">
                        <h4>{{ $berita['judul'] }}</h4>
                        <p>{{ $berita['deskripsi'] }}</p>
                        <div class="berita-footer">
                            <span class="berita-date">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                {{ $berita['tanggal'] }}
                            </span>
                            <span class="baca-selengkapnya-link" style="font-weight: 600; color: #0d6efd;">Baca Selengkapnya &rarr;</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- JURUSAN UNGGULAN --}}
<section class="jurusan-unggulan">
    <div class="section-header-center">
        <span class="line"></span>
        <h2>Jurusan Unggulan</h2>
        <span class="line"></span>
    </div>
    <div class="lihat-jurusan-wrap">
        <a href="{{ url('/jurusan') }}" class="btn-outline-small">Lihat Jurusan &rarr;</a>
    </div>

    <div class="jurusan-list">
        @foreach ($jurusanUnggulan as $jurusan)
            <a href="{{ url('/jurusan/'.strtolower($jurusan['kode'])) }}" class="jurusan-item">
                <div class="jurusan-icon">
                    @if ($jurusan['kode'] === 'PPLG')
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>
                        </svg>
                    @elseif ($jurusan['kode'] === 'TO')
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 17h2v-4.586a1 1 0 0 0-.293-.707l-3.414-3.414A1 1 0 0 0 16.586 8H14"/>
                            <path d="M14 17H9"/><circle cx="6.5" cy="17.5" r="2.5"/><circle cx="16.5" cy="17.5" r="2.5"/>
                            <path d="M4 17h-.5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h11.9"/>
                            <path d="M2 9h9"/>
                        </svg>
                    @elseif ($jurusan['kode'] === 'TPFL')
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V8l-6 4Z"/>
                            <path d="M17 18h1"/><path d="M12 18h1"/><path d="M7 18h1"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 13a10 10 0 0 1 14 0"/><path d="M8.5 16.5a5 5 0 0 1 7 0"/><path d="M2 8.82a15 15 0 0 1 20 0"/><line x1="12" y1="20" x2="12.01" y2="20"/>
                        </svg>
                    @endif
                </div>
                <div class="jurusan-text">
                    <strong>{{ $jurusan['kode'] }}</strong>
                    <span>{{ $jurusan['nama'] }}</span>
                </div>
                <span class="jurusan-arrow">&rarr;</span>
            </a>
        @endforeach
    </div>
</section>

<script src="{{ asset('js/animasi-klik.js') }}"></script>
<script src="{{ asset('js/animasi-muncul.js') }}"></script>

@endsection