<?php

use App\Models\Auth\AuthUser;

return [

    // ... (other parts remain unchanged)

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'sanctum',
            'provider' => 'users',
        ],
        'auth_users' => [
            'driver' => 'sanctum', 
            'provider' => 'auth_users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\Auth\AuthUser::class),
        ],

        'auth_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\Auth\AuthUser::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
