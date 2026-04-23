<?php

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'user'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'user'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */

    'guards' => [

        'user' => [
            'driver' => 'session',
            'provider' => 'frontend_users',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'backend_users',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [

        'frontend_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\backendUser\FrontendUser::class,
        ],

        'backend_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\backendUser\BackendUser::class,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [

        'user' => [
            'provider' => 'frontend_users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'admin' => [
            'provider' => 'backend_users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
