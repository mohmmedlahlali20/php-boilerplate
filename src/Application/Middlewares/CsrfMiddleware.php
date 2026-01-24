<?php

namespace App\Application\Middlewares;

use App\Core\Middleware\MiddlewareInterface;
use App\Core\Security\Csrf;
use App\Core\Http\Response;

class CsrfMiddleware implements MiddlewareInterface
{
    public function handle($request, callable $next)
    {
        // Only check POST, PUT, DELETE, PATCH
        $method = $_SERVER['REQUEST_METHOD'];
        
        if (in_array(strtoupper($method), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
            
            if (!Csrf::validate($token)) {
                // Return 419 Page Expired or 403 Forbidden
                http_response_code(403);
                echo "<h1>403 Forbidden - Invalid CSRF Token</h1>";
                exit; // Stop execution
            }
        }

        return $next($request);
    }
}
