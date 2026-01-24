<?php

namespace App\Core\Middleware;

interface MiddlewareInterface
{
    /**
     * Handle an incoming request.
     *
     * @param  mixed  $request
     * @param  callable  $next
     * @return mixed
     */
    public function handle($request, callable $next);
}
