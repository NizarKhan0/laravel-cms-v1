<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\DynamicPermissionHelper;

class CheckDynamicPermission
{
    public function handle(Request $request, Closure $next, string $action, string $modelClass)
    {
        if (!$request->user()) {
            abort(403);
        }

        $permission = DynamicPermissionHelper::permissionName($action, $modelClass);
        if (!$request->user()->can($permission)) {
            abort(403);
        }

        return $next($request);
    }
}
