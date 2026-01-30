<?php

return [
    'name' => $_ENV['APP_NAME'] ?? 'Demon Framework',
    'env' => $_ENV['APP_ENV'] ?? 'production',
    'debug' => (bool) ($_ENV['APP_DEBUG'] ?? false),
    'url' => $_ENV['APP_URL'] ?? 'http://localhost',
    'timezone' => 'UTC',
    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    */
    'providers' => [
        \App\Core\Providers\AppServiceProvider::class,
        \App\Core\Providers\RouteServiceProvider::class,
        \App\Core\Providers\DatabaseServiceProvider::class,
    ],
];
