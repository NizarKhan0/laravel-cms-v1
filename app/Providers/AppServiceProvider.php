<?php

namespace App\Providers;

use App\Observers\ActivityObserver;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Spatie\Activitylog\Models\Activity;

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
        Activity::observe(ActivityObserver::class);

        // Dynamic permission directive removed; using default Spatie permissions

        //override lobal sendemail guard admin
        // ResetPassword::createUrlUsing(function ($notifiable, $token) {
        //     return route('admin.password.reset', [
        //         'token' => $token,
        //         'email' => $notifiable->email,
        //     ]);
        // });
    }
}
