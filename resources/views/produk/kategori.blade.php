@extends('layouts.app')

@section('title', $kategoriLabel . ' - Produk - SMKN 4 Bogor')

@section('content')

<section class="page-hero page-hero-small">
    <img src="{{ asset('images/produk-hero-bg.png') }}" alt="SMKN 4 Bogor" class="page-hero-bg">
    <div class="page-hero-content" style="text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <h1 style="text-align: center; width: 100%;"><span class="hero-accent">{{ $kategoriLabel }}</span></h1>
        <p style="text-align: center; width: 100%; margin: 0 auto;">Semua produk pada kategori {{ $kategoriLabel }}</p>
    </div>
</section>

<div class="informasi-wrap">
    <div class="kembali-wrap kembali-top">
        <a href="{{ url('/produk') }}" class="link-kembali">&larr; Kembali</a>
    </div>

    <div class="kategori-section">
        @if (count($items) === 0)
            <p class="empty-text">Belum ada produk pada kategori ini.</p>
        @else
            <div class="informasi-grid">
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
        @endif
    </div>
</div>

<script src="{{ asset('js/animasi-klik.js') }}"></script>
<script src="{{ asset('js/animasi-muncul.js') }}"></script>

@endsection