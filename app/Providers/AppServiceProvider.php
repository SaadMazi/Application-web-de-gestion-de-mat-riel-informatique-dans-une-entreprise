<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// 1. Ajoute cette ligne ici :
use Illuminate\Support\Facades\Schema;

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
        // 2. Ajoute cette ligne ici :
        Schema::defaultStringLength(191);
    }
}
