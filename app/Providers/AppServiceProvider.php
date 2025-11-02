<?php

namespace App\Providers;
use App\Providers\Blade;
use Illuminate\Support\ServiceProvider;
use App\View\Components\Forms\Alert;
use App\View\Components\Header\Nav;
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
        
    }
}
