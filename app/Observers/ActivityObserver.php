<?php

namespace App\Observers;

use Spatie\Activitylog\Models\Activity;

class ActivityObserver
{
    //for get detail info while use auto activity log spatie in model
    public function creating(Activity $activity): void
    {
         // Check if we are running in the console
        if (app()->runningInConsole()) {
            return;
        }

        $activity->url = request()?->fullUrl();
        $activity->ip_address = request()?->ip();
        $activity->user_agent = request()?->userAgent();
    }
}
