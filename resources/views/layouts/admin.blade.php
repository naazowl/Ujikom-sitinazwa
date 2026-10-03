<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Portal - SMKN 4 Bogor')</title>

    <script src="{{ asset('js/animasi-masuk.js') }}"></script>

    @vite(['resources/css/app.css'])
</head>

<body>

@php
    $jumlahBelumDibaca = \App\Models\Pesan::where('sudah_dibaca', false)->count();
    $sekarang = now('Asia/Jakarta')->locale('id');
    $jam = (int) $sekarang->format('H');
    $sapaan = $jam < 11 ? 'Selamat pagi' : ($jam < 15 ? 'Selamat siang' : ($jam < 18 ? 'Selamat sore' : 'Selamat malam'));
@endphp

<div class="admin-body">

    <aside class="admin-sidebar">

        <div class="admin-logo">

            <div class="admin-logo-circle">
                <img
                    src="{{ asset('images/logo-smkn4.png') }}"
                    alt="Logo SMKN 4 Bogor"
                >
            </div>

            <strong>SMK NEGERI 4</strong>

        </div>

        <nav class="admin-nav">

            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>

                Dashboard

            </a>


            <a href="{{ route('admin.informasi.index') }}"
               class="{{ request()->routeIs('admin.informasi.*') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="16" x2="12" y2="12"/>
                    <line x1="12" y1="8" x2="12.01" y2="8"/>
                </svg>

                Informasi

            </a>


            <a href="{{ route('admin.galeri.index') }}"
               class="{{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <circle cx="8.5" cy="8.5" r="1.5"/>
                    <polyline points="21 15 16 10 5 21"/>
                </svg>

                Galeri

            </a>


            <a href="{{ route('admin.jurusan.index') }}"
               class="{{ request()->routeIs('admin.jurusan.*') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>

                Jurusan

            </a>


            <a href="{{ route('admin.produk.index') }}"
               class="{{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"/>
                    <circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                </svg>

                Produk

            </a>


            <a href="{{ route('admin.pesan.index') }}"
               class="{{ request()->routeIs('admin.pesan.*') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>

                Pesan

                @if ($jumlahBelumDibaca > 0)
                    <span class="admin-nav-badge">{{ $jumlahBelumDibaca }}</span>
                @endif

            </a>


            <a href="{{ url('/') }}" target="website-preview" class="admin-nav-website">

                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>

                Kembali ke Beranda

            </a>


            <form action="{{ route('logout') }}" method="POST" id="logoutForm" class="admin-logout-form">
                @csrf

                <button type="button" class="admin-logout-button" onclick="bukaKonfirmasiLogout()">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>

                    Logout

                </button>
            </form>

        </nav>

    </aside>

    <div class="admin-sidebar-overlay" id="adminSidebarOverlay"></div>


    <main class="admin-main">

        <div class="admin-topbar">

            <div class="admin-topbar-left">
                <button type="button" class="admin-menu-toggle" id="adminMenuToggle" aria-label="Buka menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>

                <div>
                    <h1>Admin Portal</h1>
                    <span class="admin-topbar-date">{{ $sekarang->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>

            <div class="admin-topbar-right">

                <a href="{{ route('admin.pesan.index') }}" class="admin-topbar-bell" aria-label="Pesan masuk">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                    @if ($jumlahBelumDibaca > 0)
                        <span class="admin-topbar-bell-badge">{{ $jumlahBelumDibaca }}</span>
                    @endif
                </a>

                <div class="admin-topbar-user">
                    <span class="admin-topbar-avatar">A</span>
                    <span class="admin-topbar-greet">{{ $sapaan }}, Admin 👋</span>
                </div>

            </div>

        </div>


        <div class="admin-content">

            @yield('content')

        </div>

        @if (session('success'))
            @php
                $toastType = session('toast_type', 'create');

                $toastTitle = match ($toastType) {
                    'create' => 'Berhasil Ditambahkan!',
                    'update' => 'Berhasil Diperbarui!',
                    'delete' => 'Berhasil Dihapus!',
                    default  => 'Berhasil!',
                };
            @endphp

            <div class="admin-toast" id="adminToast">

                <div class="admin-toast-icon toast-{{ $toastType }}">
                    @if ($toastType === 'create')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                    @elseif ($toastType === 'update')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 2v6h-6"/>
                            <path d="M3 12a9 9 0 0 1 15-6.7L21 8"/>
                            <path d="M3 22v-6h6"/>
                            <path d="M21 12a9 9 0 0 1-15 6.7L3 16"/>
                        </svg>
                    @elseif ($toastType === 'delete')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                    @endif
                </div>

                <div class="admin-toast-body">
                    <p class="admin-toast-title">{{ $toastTitle }}</p>
                    <p class="admin-toast-message">{{ session('success') }}</p>
                </div>

                <button type="button" class="admin-toast-close" onclick="document.getElementById('adminToast').classList.remove('is-show')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>

                <div class="admin-toast-progress toast-{{ $toastType }}"></div>

            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const toast = document.getElementById('adminToast');
                    setTimeout(() => toast.classList.add('is-show'), 100);
                    setTimeout(() => toast.classList.remove('is-show'), 3100);
                });
            </script>
        @endif

    </main>

</div>


<div class="admin-confirm-overlay" id="logoutConfirm" onclick="if (event.target === this) tutupKonfirmasiLogout()">
    <div class="admin-confirm-box">

        <div class="admin-confirm-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
        </div>

        <h3 class="admin-confirm-title">Keluar dari Admin?</h3>
        <p class="admin-confirm-text">Anda akan keluar dari halaman admin dan perlu login lagi untuk masuk kembali.</p>

        <div class="admin-confirm-actions">
            <button type="button" class="admin-confirm-cancel" onclick="tutupKonfirmasiLogout()">Batal</button>
            <button type="button" class="admin-confirm-ok" onclick="document.getElementById('logoutForm').submit()">Ya, Keluar</button>
        </div>

    </div>
</div>

<script>
    function bukaKonfirmasiLogout() {
        document.getElementById('logoutConfirm').classList.add('is-open');
    }

    function tutupKonfirmasiLogout() {
        document.getElementById('logoutConfirm').classList.remove('is-open');
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') tutupKonfirmasiLogout();
    });
</script>

<script>
    const adminMenuToggle = document.getElementById('adminMenuToggle');
    const adminSidebar = document.querySelector('.admin-sidebar');
    const adminSidebarOverlay = document.getElementById('adminSidebarOverlay');

    adminMenuToggle?.addEventListener('click', function () {
        adminSidebar.classList.add('is-open');
        adminSidebarOverlay.classList.add('is-open');
    });

    adminSidebarOverlay?.addEventListener('click', function () {
        adminSidebar.classList.remove('is-open');
        adminSidebarOverlay.classList.remove('is-open');
    });
</script>

@stack('scripts')

</body>
</html>