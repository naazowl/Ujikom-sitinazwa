@extends('layouts.auth')

@section('title', 'Login - SMKN 4 Bogor')

@section('content')

<div class="login-page">
    <img src="{{ asset('images/hero-lapangan.jpg') }}" alt="SMKN 4 Bogor" class="login-bg">

    <a href="{{ url('/') }}" class="login-back" aria-label="Kembali ke Beranda">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
        <span>Kembali ke Beranda</span>
    </a>

    <div class="login-card {{ $errors->any() ? 'has-error' : '' }}">
        <div class="login-head">
            <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo SMKN 4 Bogor" class="login-logo" onerror="this.style.display='none'">
            <h1>SMKN 4 KOTA BOGOR</h1>
            <p>Masuk untuk mengelola konten website</p>
        </div>

        @if ($errors->any())
            <div class="login-error" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <span>{{ $errors->first('login') ?: $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" autocomplete="off" class="login-form">
            @csrf

            <div class="login-field">
                <label for="username">Username</label>
                <div class="login-input-wrap">
                    <svg class="login-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                    </svg>
                    <input type="text" id="username" name="username" placeholder="Username" value=""
                           autocomplete="off" readonly onfocus="this.removeAttribute('readonly')" required>
                </div>
            </div>

            <div class="login-field">
                <label for="password">Password</label>
                <div class="login-input-wrap">
                    <svg class="login-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <input type="password" id="password" name="password" placeholder="Password" value=""
                           autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly')" required>
                    <button type="button" class="login-toggle" id="togglePassword" aria-label="Tampilkan password">
                        <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                        <svg class="eye-closed" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="login-btn" id="loginBtn">
                <span class="login-btn-label">Login</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/>
                </svg>
            </button>
        </form>
    </div>

    <p class="login-footer">&copy; {{ date('Y') }} SMKN 4 Kota Bogor</p>
</div>

<script>
    (function () {
        var form = document.querySelector('.login-form');
        var u = document.getElementById('username');
        var p = document.getElementById('password');
        var btn = document.getElementById('loginBtn');
        var label = btn.querySelector('.login-btn-label');
        var toggle = document.getElementById('togglePassword');
        var labelText = label.textContent;

        function kosongkanFormLogin() {
            if (u) u.value = '';
            if (p) p.value = '';
        }

        function resetTombol() {
            btn.disabled = false;
            btn.classList.remove('loading');
            label.textContent = labelText;
        }

        toggle.addEventListener('click', function () {
            var show = p.type === 'password';
            p.type = show ? 'text' : 'password';
            toggle.classList.toggle('active', show);
            toggle.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        });

        form.addEventListener('submit', function () {
            btn.classList.add('loading');
            label.textContent = 'Memproses...';
            setTimeout(function () { btn.disabled = true; }, 0);
        });

        window.addEventListener('pageshow', function () {
            kosongkanFormLogin();
            setTimeout(kosongkanFormLogin, 150);
            resetTombol();
            p.type = 'password';
            toggle.classList.remove('active');
        });
    })();
</script>

@endsection