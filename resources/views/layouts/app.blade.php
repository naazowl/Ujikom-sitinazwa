<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <!-- Mengunci skala zoom untuk perangkat mobile / touch screen -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'SMKN 4 Bogor')</title>
    
    <style>
        /* Mencegah gerak pinch-zoom pada layar sentuh & trackpad */
        html, body {
            touch-action: pan-x pan-y;
        }
    </style>

    @vite(['resources/css/app.css'])
</head>
<body>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Script pencegah tombol pintasan zoom keyboard & scroll wheel desktop -->
    <script>
        // Mencegah Ctrl + Scroll Wheel (Zoom)
        document.addEventListener('wheel', function (e) {
            if (e.ctrlKey) {
                e.preventDefault();
            }
        }, { passive: false });

        // Mencegah Tombol Keyboard Ctrl + (+) / Ctrl + (-) / Ctrl + 0
        document.addEventListener('keydown', function (e) {
            if (e.ctrlKey && (e.key === '+' || e.key === '-' || e.key === '=' || e.key === '0')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>