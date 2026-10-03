@extends('layouts.app')

@section('title', $kategoriLabel . ' - SMKN 4 Bogor')

@section('content')

<section class="page-hero page-hero-small">
    <img src="{{ asset('images/page-hero-bg.png') }}" alt="SMKN 4 Bogor" class="page-hero-bg">
    <div class="page-hero-content" style="text-align: center;">
        <h1 style="text-align: center;"><span class="hero-accent">{{ $kategoriLabel }}</span></h1>
        <p style="text-align: center; max-width: 100%; margin: 0 auto;">Semua informasi pada kategori {{ strtolower($kategoriLabel) }}</p>
    </div>
</section>

<div class="informasi-wrap">
    <div class="kembali-wrap kembali-top">
        <a href="{{ url('/informasi') }}" class="link-kembali">&larr; Kembali</a>
    </div>

    <div class="kategori-section">
        @if (count($items) === 0)
            <p class="empty-text">Belum ada informasi pada kategori ini.</p>
        @else
            <div class="informasi-grid">
                @foreach ($items as $item)
                    <a href="{{ url('/informasi/'.$item['slug']) }}" class="informasi-card" style="text-decoration: none; color: inherit;">
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
                                <span class="informasi-author"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg> {{ $item['author'] }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script src="{{ asset('js/animasi-klik.js') }}"></script>
<script src="{{ asset('js/animasi-muncul.js') }}"></script>

@endsection