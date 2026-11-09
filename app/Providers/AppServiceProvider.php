<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // Tambahan untuk memanggil Paginator

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mengubah tampilan default pagination bawaan Laravel (Tailwind) menjadi Bootstrap 5
        Paginator::useBootstrapFive();
    }
}