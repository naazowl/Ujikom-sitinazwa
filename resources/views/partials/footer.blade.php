<footer class="footer">
    <div class="footer-container">

        <div class="footer-col footer-col-brand">
            <div class="footer-brand">
                <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo SMKN 4 Bogor">
                <h3>SMKN 4 BOGOR</h3>
            </div>
            <p class="footer-tagline">Pusat keunggulan pendidikan kejuruan yang mencetak lulusan kompeten, berkarakter, dan siap kerja.</p>
        </div>

        <div class="footer-col">
            <h4 class="footer-col-title">Tautan Cepat</h4>
            <nav class="footer-links">
                <a href="{{ url('/') }}">Beranda</a>
                <a href="{{ url('/informasi') }}">Informasi Umum</a>
                <a href="{{ url('/jurusan') }}">Jurusan</a>
                <a href="{{ url('/produk') }}">Produk</a>
                <a href="{{ url('/kontak') }}">Kontak</a>
            </nav>
        </div>

        <div class="footer-col">
            <h4 class="footer-col-title">Jam Operasional</h4>
            <p class="footer-hours">
                Senin &ndash; Jumat<br>
                <strong>06.30 &ndash; 17.00</strong>
            </p>
        </div>

    </div>

    <div class="footer-bottom">
        Copyright &copy; 2025 - {{ date('Y') }} <a href="{{ url('/') }}">SMKN 4 Bogor.</a>
    </div>
</footer>