<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Path ke route default setelah login
     */
    public const HOME = '/dashboard';

    /**
     * Daftarkan semua route aplikasi
     */
    public function boot(): void
    {
        // Tambahkan logging agar bisa debug apakah file ini dipanggil
        Log::info('RouteServiceProvider: boot() called');

        $this->routes(function () {
            // Tambahkan logging sebelum register route
            Log::info('RouteServiceProvider: Registering API and WEB routes');

            // Group untuk routes/api.php
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Group untuk routes/web.php
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}