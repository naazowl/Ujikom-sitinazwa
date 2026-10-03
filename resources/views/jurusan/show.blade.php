@extends('layouts.app')

@section('title', $item['nama'] . ' - SMKN 4 Bogor')

@section('content')

<section class="page-hero">
    <img src="{{ asset('images/jurusan-hero-bg.png') }}" alt="SMKN 4 Bogor" class="page-hero-bg">

    <div class="page-hero-content">
        <h1>
            Program <span class="hero-accent">Keahlian</span><br>
            SMKN 4 Bogor
        </h1>

        <p>
            SMKN 4 Kota Bogor memiliki 4 program keahlian yang dirancang untuk
            membekali siswa dengan keterampilan, pengetahuan, dan sikap profesional
            sesuai kebutuhan dunia kerja dan industri.
        </p>
    </div>
</section>

<div class="jurusan-detail-wrap">

    <div class="jurusan-detail-header">

        <div class="jurusan-detail-badge">

            @if ($item['kode'] === 'PPLG')

                <img
                    src="{{ asset('images/' . $item['icon']) }}"
                    alt="{{ $item['kode'] }}"
                    class="jurusan-detail-icon"
                >

                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <polyline points="16 18 22 12 16 6"/>
                    <polyline points="8 6 2 12 8 18"/>
                </svg>

            @elseif ($item['kode'] === 'TO')

                <img
                    src="{{ asset('images/' . $item['icon']) }}"
                    alt="{{ $item['kode'] }}"
                    class="jurusan-detail-icon"
                >

                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M19 17h2v-4.586a1 1 0 0 0-.293-.707l-3.414-3.414A1 1 0 0 0 16.586 8H14"/>
                    <path d="M14 17H9"/>
                    <circle cx="6.5" cy="17.5" r="2.5"/>
                    <circle cx="16.5" cy="17.5" r="2.5"/>
                    <path d="M4 17h-.5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h11.9"/>
                    <path d="M2 9h9"/>
                </svg>

            @elseif ($item['kode'] === 'TPFL')

                <img
                    src="{{ asset('images/' . $item['icon']) }}"
                    alt="{{ $item['kode'] }}"
                    class="jurusan-detail-icon"
                >

                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V8l-6 4Z"/>
                    <path d="M17 18h1"/>
                    <path d="M12 18h1"/>
                    <path d="M7 18h1"/>
                </svg>

            @else

                <img
                    src="{{ asset('images/' . $item['icon']) }}"
                    alt="{{ $item['kode'] }}"
                    class="jurusan-detail-icon"
                >

                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M5 13a10 10 0 0 1 14 0"/>
                    <path d="M8.5 16.5a5 5 0 0 1 7 0"/>
                    <path d="M2 8.82a15 15 0 0 1 20 0"/>
                    <line x1="12" y1="20" x2="12.01" y2="20"/>
                </svg>

            @endif

        </div>

        <div>
            <h1>{{ $item['kode'] }}</h1>
            <span>{{ $item['nama'] }}</span>
        </div>

    </div>

    <div class="jurusan-detail-desc-box">
        {{ $item['deskripsi_lengkap'] }}
    </div>

    <div class="jurusan-detail-grid">

        <div class="jurusan-left-col">

            <div class="jurusan-detail-photo">
                <img
                    src="{{ asset('images/' . $item['foto']) }}"
                    alt="{{ $item['nama'] }}"
                >
            </div>

            <div class="jurusan-detail-col">

                <h4>Prospek Karier</h4>

                <p class="jurusan-detail-col-sub">
                    Lulusan memiliki peluang karier yang luas
                </p>

                @foreach ($item['prospek'] as $prospek)
                    <div class="jurusan-list-item">
                        <span>{{ $prospek }}</span>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="jurusan-detail-col">

            <h4>Prestasi Jurusan</h4>

            <p class="jurusan-detail-col-sub">
                Beberapa prestasi yang telah diraih
            </p>

            <div class="prestasi-list">
                @foreach ($item['prestasi'] as $prestasi)
                    <div class="prestasi-item">

                        <div class="prestasi-icon">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M8.21 13.89 7 23l5-3 5 3-1.21-9.12"/>
                                <circle cx="12" cy="8" r="7"/>
                            </svg>
                        </div>

                        <div class="prestasi-text">
                            <span>{!! $prestasi !!}</span>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>

    </div>

    <div class="kembali-wrap">
        <a href="{{ url('/jurusan') }}" class="link-kembali">
            ← Kembali
        </a>
    </div>

</div>

<script src="{{ asset('js/animasi-klik.js') }}"></script>
<script src="{{ asset('js/animasi-muncul.js') }}"></script>

@endsection