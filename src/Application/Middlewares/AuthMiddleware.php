<?php

namespace App\Application\Middlewares;

use App\Core\Middleware\MiddlewareInterface;
use App\Core\Http\Response;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle($request, callable $next)
    {
        // Ensure session is started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        // Ideally this checks specific user session key, e.g. 'user_id'
        if (empty($_SESSION['user_id'])) {
            // Redirect to login or home if not authenticated
             return Response::redirect('/');
        }

        // Continue to next middleware
        return $next($request);
    }
}
