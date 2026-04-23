<?php

namespace App\Observers;

use Spatie\Activitylog\Models\Activity;

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

        // 🔥 detect user type (admin / frontend)
        if (auth('admin')->check()) {
            $activity->log_name = 'Backend User';
            $activity->causer_type = 'admin';
            $activity->causer_id = auth('admin')->id();
        } elseif (auth('user')->check()) {
            $activity->log_name = 'Frontend User';
            $activity->causer_type = 'frontend';
            $activity->causer_id = auth('user')->id();
        } else {
            $activity->log_name = 'System';
        }
    }
}
