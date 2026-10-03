@extends('layouts.app')

@section('title', $item['nama'] . ' - SMKN 4 Bogor')

@section('content')

<section class="page-hero page-hero-small">
    <img src="{{ asset('images/produk-hero-bg.png') }}" alt="SMKN 4 Bogor" class="page-hero-bg">
    <div class="page-hero-content" style="text-align: center;">
        <h1 style="text-align: center;"><span class="hero-accent">Produk</span></h1>
        <p style="text-align: center; max-width: 100%; margin: 0 auto;">Berbagai produk hasil karya siswa yang dibuat melalui pembelajaran berbasis praktik.</p>
    </div>
</section>

<div class="informasi-wrap informasi-detail-wrap">
    <div class="informasi-detail-card produk-detail-card">
        <div class="produk-kategori-label" style="display: inline-flex; align-items: center; gap: 8px; margin-bottom: 15px;">
            <svg style="width: 16px; height: 16px; min-width: 16px; min-height: 16px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; display: inline-block;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 20h9"/>
                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
            </svg>
            <span style="display: inline-block;">{{ $item['kategori_produk'] }}</span>
        </div>

        <div class="informasi-detail-img" style="text-align: center;">
            <img src="{{ asset('images/'.$item['gambar']) }}" alt="{{ $item['nama'] }}" style="display: inline-block;">
            <span class="informasi-badge">{{ $item['kategori'] }}</span>
        </div>

        <h2 class="informasi-detail-title" style="text-align: center; width: 100%;">{{ $item['nama'] }}</h2>

        <p class="informasi-detail-body" style="text-align: center; width: 100%;">{{ $item['deskripsi_lengkap'] }}</p>
    </div>

    <div class="kembali-wrap">
        <a href="{{ url('/produk') }}" class="link-kembali">&larr; Kembali</a>
    </div>
</div>

<script src="{{ asset('js/animasi-klik.js') }}"></script>
<script src="{{ asset('js/animasi-muncul.js') }}"></script>

@endsection