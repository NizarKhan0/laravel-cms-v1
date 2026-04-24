<?php

namespace App\Http\Controllers\backendUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\backendUser\BackendUser;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    // Show logs in a Blade view (for admin/backend users)
    public function indexView(Request $request)
    {
        //  dd(auth()->guard()->name);
        // Retrieve activity logs with causer relation for readability
        $activities = Activity::with('causer')->latest()->paginate(10);
        // Return the existing blade in the project
        return view('backend-user.module.activityLog.index', [
            'activities' => $activities,
        ]);
    }

    // API endpoint to fetch logs (frontend SPA or AJAX)
    // public function indexApi(Request $request)
    // {
    //     // You can adjust filtering here, eg. by user or log_name
    //     $logs = Activity::with('causer')->latest()->take(100)->get();
    //     return response()->json($logs);
    // }
}