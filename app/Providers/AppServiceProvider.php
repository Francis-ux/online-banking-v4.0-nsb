<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
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
        Model::unguard();
        Paginator::useBootstrap();

        if (env('APP_ENV') !== 'local') {
            Schema::defaultStringLength(191);
        }

    }
}
