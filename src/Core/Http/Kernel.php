<?php

namespace App\Core\Http;

class Kernel
{
    /**
     * Global middleware run on every request.
     */
    protected array $globalMiddleware = [
        // \App\Application\Middlewares\TrimStrings::class,
    ];

    /**
     * Route middleware aliases.
     */
    protected array $routeMiddleware = [
        'auth' => \App\Application\Middlewares\AuthMiddleware::class,
    ];

    /**
     * Get global middleware.
     */
    public function getGlobalMiddleware(): array
    {
        return $this->globalMiddleware;
    }

    /**
     * Get middleware by alias.
     */
    public function getRouteMiddleware(string $key): ?string
    {
        return $this->routeMiddleware[$key] ?? null;
    }
}
