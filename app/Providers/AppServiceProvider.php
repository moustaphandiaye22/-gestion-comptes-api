<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CompteService;
class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CompteService::class, function ($app) {
            return new CompteService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
  
}
