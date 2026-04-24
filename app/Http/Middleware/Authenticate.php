<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if ($request->is('admin') || $request->is('admin/*')) {
            return route('admin.login');
        }

        if ($request->is('user') || $request->is('user/*')) {
            return route('user.login');
        }

        return route('user.login');
    }
}