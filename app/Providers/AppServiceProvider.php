<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();

        Gate::define('is_admin', function ($user) {
            return $user->hak_akses == 'ADMIN';
        });

        Gate::define('is_pasien', function ($user) {
            return $user->hak_akses == 'PASIEN';
        });

        Gate::define('is_admin_and_poli', function ($user) {
            return $user->hak_akses != 'PASIEN';
        });
    }
}
