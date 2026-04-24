<?php

namespace App\Providers;

use App\Observers\ActivityObserver;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Helpers\DynamicPermissionHelper;
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

        // Register dynamic permission blade directive for easy view-based checks
        Blade::if('dynamiccan', function (string $action, string $modelClass) {
            return auth()->check() && auth()->user()->can(DynamicPermissionHelper::permissionName($action, $modelClass));
        });

        //override lobal sendemail guard admin
        // ResetPassword::createUrlUsing(function ($notifiable, $token) {
        //     return route('admin.password.reset', [
        //         'token' => $token,
        //         'email' => $notifiable->email,
        //     ]);
        // });
    }
}
