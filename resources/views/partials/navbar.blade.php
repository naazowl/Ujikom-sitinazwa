<header class="navbar">
    <div class="navbar-container">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo SMKN 4 Bogor">
            <span>SMKN 4 BOGOR</span>
        </a>

        <nav class="navbar-menu">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
            <a href="{{ url('/informasi') }}" class="{{ request()->is('informasi*') ? 'active' : '' }}">Informasi umum</a>
            <a href="{{ url('/jurusan') }}" class="{{ request()->is('jurusan*') ? 'active' : '' }}">Jurusan</a>
            <a href="{{ url('/produk') }}" class="{{ request()->is('produk*') ? 'active' : '' }}">Produk</a>
            <a href="{{ url('/kontak') }}" class="{{ request()->is('kontak*') ? 'active' : '' }}">Kontak</a>
        </nav>

        <a href="{{ url('/login') }}" class="btn-login">Login</a>

        <button type="button" class="navbar-toggle" id="navbarToggle" aria-label="Buka menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>
    </div>
</header>

<script>
    const navbarToggle = document.getElementById('navbarToggle');
    const navbarMenu = document.querySelector('.navbar-menu');

    navbarToggle?.addEventListener('click', function () {
        navbarMenu.classList.toggle('is-open');
    });
</script>