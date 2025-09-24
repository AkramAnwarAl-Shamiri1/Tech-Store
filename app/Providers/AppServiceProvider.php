<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
      
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();

               
                $notifications = $user->role_id == 1
                    ? \App\Models\Notification::orderBy('created_at', 'desc')->get()
                    : $user->notifications()->orderBy('created_at', 'desc')->get();

                $view->with('globalNotifications', $notifications);
            }
        });
    }
}
