<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth; 
use App\Models\Message;



class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }


    public function boot(): void
    {

        View::composer(['layouts.app'], function ($view) {
            $unreadMessagesCount = 0;
            
            if (Auth::check()) {

                $unreadMessagesCount = Message::where('receiver_id', Auth::id())
                                              ->where('is_read', false)
                                              ->count();
            }

            $view->with('unreadMessagesCount', $unreadMessagesCount);
        });

    }
}