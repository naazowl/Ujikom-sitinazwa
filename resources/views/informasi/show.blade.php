@extends('layouts.app')

@section('title', $item['judul'] . ' - SMKN 4 Bogor')

@section('content')

<section class="page-hero page-hero-small">
    <img src="{{ asset('images/page-hero-bg.png') }}" alt="SMKN 4 Bogor" class="page-hero-bg">
    <div class="page-hero-content" style="text-align: center; margin-left: auto; margin-right: auto;">
        <h1 style="text-align: center;">Informasi Terbaru &amp; Galeri</h1>
        <p style="text-align: center; margin-left: auto; margin-right: auto;">Informasi terkini &amp; galeri mengenai kegiatan serta prestasi di SMKN 4 Bogor</p>
    </div>
</section>

<div class="informasi-wrap informasi-detail-wrap">
    <div class="informasi-detail-top" style="margin-bottom: 16px;">
        <span class="informasi-badge" style="position: static; display: inline-block;">{{ $item['kategori'] }}</span>
    </div>

    <div class="informasi-detail-card">
        <div class="informasi-detail-img">
            <img src="{{ asset('images/'.$item['gambar']) }}" alt="{{ $item['judul'] }}">
        </div>

        <div class="informasi-detail-meta">
            <span class="informasi-date">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                {{ $item['tanggal'] }}
            </span>
            <span class="informasi-author"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg> {{ $item['author'] }}</span>
        </div>

        <h2 class="informasi-detail-title">{{ $item['judul'] }}</h2>

        <p class="informasi-detail-body">{{ $item['isi'] }}</p>

        @if (!empty($item['hashtag']))
            <p class="informasi-detail-hashtag">{{ $item['hashtag'] }}</p>
        @endif
    </div>

    <div class="kembali-wrap">
        <a href="{{ url('/informasi') }}" class="link-kembali">&larr; Kembali</a>
    </div>
</div>

<script src="{{ asset('js/animasi-klik.js') }}"></script>
<script src="{{ asset('js/animasi-muncul.js') }}"></script>

@endsection