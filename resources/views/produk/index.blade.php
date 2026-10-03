@extends('layouts.app')

@section('title', 'Produk - SMKN 4 Bogor')

@section('content')

<section class="page-hero produk-page-hero">
    <img src="{{ asset('images/produk-hero-bg.png') }}" alt="SMKN 4 Bogor" class="page-hero-bg">
    <div class="page-hero-content" style="text-align: center;">
        <h1 style="text-align: center;"><span class="hero-accent">Produk</span></h1>
        <p style="text-align: center; max-width: 100%; margin: 0 auto;">Berbagai produk hasil karya siswa yang dibuat melalui pembelajaran berbasis praktik.</p>
    </div>
</section>

<div class="search-bar-wrap" style="display: flex; justify-content: center;">
    <form action="{{ url('/produk') }}" method="GET" class="search-bar">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" name="q" placeholder="Cari produk..." value="{{ $keyword }}">
    </form>
</div>

<div class="informasi-wrap">
    @foreach ($grouped as $label => $items)
        <div class="kategori-section">
            <div class="kategori-header">
                <span class="kategori-badge">{{ $label }}</span>
                @if (count($items) > 0)
                    <a href="{{ url('/produk/kategori/'.strtolower($label)) }}" class="btn-outline-small">Lihat Semua &rarr;</a>
                @endif
            </div>

            @if (count($items) === 0)
                <p class="empty-text">Belum ada produk pada kategori ini.</p>
            @else
                <div class="informasi-scroll-wrap">
                    <div class="informasi-track">
                        @foreach ($items as $item)
                            <a href="{{ url('/produk/'.$item['slug']) }}" class="informasi-card">
                                <div class="informasi-img-wrap">
                                    <img src="{{ asset('images/'.$item['gambar']) }}" alt="{{ $item['nama'] }}">
                                    <span class="informasi-card-badge">{{ $item['kategori'] }}</span>
                                </div>
                                <div class="informasi-body">
                                    <h4>{{ $item['nama'] }}</h4>
                                    <p>{{ $item['deskripsi_singkat'] }}</p>
                                    <div class="informasi-footer">
                                        <span>Baca Selengkapnya &rarr;</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>

<script src="{{ asset('js/animasi-klik.js') }}"></script>
<script src="{{ asset('js/animasi-muncul.js') }}"></script>

@endsection