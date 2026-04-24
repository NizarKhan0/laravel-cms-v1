<?php

namespace App\Observers;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityObserver
{
    //for get detail info while use auto activity log spatie in model
    public function creating(Activity $activity): void
    {
        // Skip kalau run via console (cron, artisan, queue)
        if (app()->runningInConsole()) {
            return;
        }

        $request = request();

        $activity->url = $request?->fullUrl();
        $activity->ip_address = $request?->ip();
        $activity->user_agent = $request?->userAgent();

        // Set causer from authenticated user if not already set
        if (!$activity->causer_type) {
            // Get the route middleware to determine which guard should be active
            $routeMiddleware = $request->route()?->middleware() ?? [];
            $hasAdminAuth = in_array('auth:admin', $routeMiddleware);
            $hasUserAuth = in_array('auth:user', $routeMiddleware);

            // Priority logic based on route middleware:
            // 1. If route requires admin auth, use admin guard
            // 2. If route requires user auth, use user guard
            // 3. Otherwise (public route), use subject as causer
            
            if ($hasAdminAuth && Auth::guard('admin')->check()) {
                $adminUser = Auth::guard('admin')->user();
                $activity->causer_type = get_class($adminUser);
                $activity->causer_id = $adminUser->id;
            } 
            elseif ($hasUserAuth && Auth::guard('user')->check()) {
                $frontendUser = Auth::guard('user')->user();
                $activity->causer_type = get_class($frontendUser);
                $activity->causer_id = $frontendUser->id;
            }
            // Fallback: use subject as causer (for public routes like registration)
            elseif ($activity->subject_type && $activity->subject_id) {
                $activity->causer_type = $activity->subject_type;
                $activity->causer_id = $activity->subject_id;
            }
        }

        // Set log_name based on causer type
        if ($activity->causer_type) {
            if (str_contains($activity->causer_type, 'BackendUser')) {
                $activity->log_name = 'Backend User';
            } elseif (str_contains($activity->causer_type, 'FrontendUser')) {
                $activity->log_name = 'Frontend User';
            }
        }
    }
}

