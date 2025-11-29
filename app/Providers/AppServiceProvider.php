<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Gate; 
use App\Models\Product;



class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }


    public function boot(): void
    {
        Gate::define('purchase', function($user, Product $product)
        {
            return $user->wallet >= $product->price;
        });
    }
}