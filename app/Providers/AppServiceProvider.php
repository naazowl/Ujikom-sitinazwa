<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Di hosting cPanel, isi folder "public" ada di public_html
        // (sejajar dengan folder project). Di lokal folder ini tidak ada,
        // jadi pengaturan bawaan Laravel tetap dipakai.
        $hostingPublic = dirname(base_path()) . '/public_html';

        if (is_dir($hostingPublic)) {
            $this->app->usePublicPath($hostingPublic);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}