@extends('layouts.app')

@section('title', 'Kontak - SMKN 4 Bogor')

@section('content')

<section class="kontak-full-hero">
    <img src="{{ asset('images/kontak-hero-bg.png') }}" alt="SMKN 4 Bogor" class="page-hero-bg">

    <div class="kontak-hero-text page-hero-content">
        <h1><span class="hero-accent">Kontak</span></h1>
        <p>Hubungi kami untuk mendapatkan informasi lebih lanjut mengenai sekolah, program pendidikan, maupun layanan yang tersedia.</p>
    </div>

    <div class="kontak-wrap">
        <div class="kontak-card">
            <div class="kontak-info">
                <div class="kontak-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/>
                    </svg>
                    <a href="https://www.google.com/maps?q=SMKN+4+Bogor" target="_blank" class="kontak-link">{{ $kontak['alamat'] }}</a>
                </div>

                <div class="kontak-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92Z"/>
                    </svg>
                    <a href="tel:+6282260168886" class="kontak-link">{{ $kontak['telepon'] }}</a>
                </div>

                <div class="kontak-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                    </svg>
                    <a href="mailto:smkn4@smkn4bogor.sch.id" class="kontak-link">{{ $kontak['email'] }}</a>
                </div>

                <div class="kontak-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/>
                    </svg>
                    <a href="https://youtube.com/@smknegeri4bogor905" target="_blank" class="kontak-link">{{ $kontak['youtube'] }}</a>
                </div>

                <div class="kontak-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                    </svg>
                    <a href="https://www.facebook.com/100054636630766/about/?_rdr" target="_blank" class="kontak-link">{{ $kontak['facebook'] }}</a>
                </div>

                <div class="kontak-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                    </svg>
                    <a href="https://instagram.com/smkn4kotabogor" target="_blank" class="kontak-link">{{ $kontak['instagram'] }}</a>
                </div>
            </div>

            <div class="kontak-map">
                <iframe
                    src="{{ $kontak['maps_embed'] }}"
                    width="100%" height="100%" style="border:0;" loading="lazy">
                </iframe>
            </div>
        </div>

        <div class="kontak-pesan-card">
            <h2>Kirim Pesan</h2>
            <p>Punya pertanyaan atau masukan untuk sekolah? Kirimkan pesan Anda, kami akan segera membacanya.</p>

            @if (session('kontak_success'))
                <div class="kontak-pesan-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    {{ session('kontak_success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('kontak.store') }}" class="kontak-pesan-form">
                @csrf

                <div class="kontak-pesan-row">
                    <div class="kontak-pesan-field">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap Anda">
                        @error('nama') <span class="kontak-pesan-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="kontak-pesan-field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com">
                        @error('email') <span class="kontak-pesan-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="kontak-pesan-field">
                    <label for="telepon">Nomor Telepon (opsional)</label>
                    <input type="text" id="telepon" name="telepon" value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx"
                           inputmode="numeric" pattern="[0-9]*" maxlength="20"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    @error('telepon') <span class="kontak-pesan-error">{{ $message }}</span> @enderror
                </div>

                <div class="kontak-pesan-field">
                    <label for="isi">Pesan</label>
                    <textarea id="isi" name="isi" rows="5" placeholder="Tulis pesan atau pertanyaan Anda di sini...">{{ old('isi') }}</textarea>
                    @error('isi') <span class="kontak-pesan-error">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="kontak-pesan-submit">
                    Kirim Pesan
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"/>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</section>

@endsection