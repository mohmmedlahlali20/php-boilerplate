<?php

namespace App\Core\Router;

use App\Core\Http\Request;
use App\Core\Http\Response;

class Router
{
    protected static array $routes = [];
    protected static array $middlewares = [];
    protected static ?string $lastRouteKey = null;

    // --- Route Registration ---

    public static function get($uri, $callback)
    {
        return self::addRoute('get', $uri, $callback);
    }

    public static function post($uri, $callback)
    {
        return self::addRoute('post', $uri, $callback);
    }

    public static function put($uri, $callback)
    {
        return self::addRoute('put', $uri, $callback);
    }

    public static function patch($uri, $callback)
    {
        return self::addRoute('patch', $uri, $callback);
    }

    public static function delete($uri, $callback)
    {
        return self::addRoute('delete', $uri, $callback);
    }

    /**
     * Internal method to add a route and return a Route instance (simulation for chaining).
     */
    protected static function addRoute($method, $uri, $callback)
    {
        // Convert URI params like {id} to regex groups
        // /user/{id}  ->  /user/([^/]+)
        // /posts/{slug}/edit -> /posts/([^/]+)/edit
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $uri);
        $pattern = "#^" . $pattern . "$#";

        $routeKey = $method . $uri;
        self::$lastRouteKey = $routeKey;

        self::$routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'callback' => $callback,
            'middlewares' => []
        ];

        return new static; // return instance to allow chaining
    }

    /**
     * Attach middleware to the last registered route.
     * Usage: Router::get(...)->middleware('auth');
     */
    public function middleware(string $alias)
    {
        // Add middleware to the last route in the array
        $lastKey = array_key_last(self::$routes);
        if ($lastKey !== null) {
            self::$routes[$lastKey]['middlewares'][] = $alias;
        }
        return $this;
    }


    // --- Resolution ---

    public static function resolve()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
        
        // --- Method Spoofing ---
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        if ($method === 'post' && isset($_POST['_method'])) {
            $spoofed = strtolower($_POST['_method']);
            if (in_array($spoofed, ['put', 'patch', 'delete'])) {
                $method = $spoofed;
            }
        }

        // --- Iteration & Matching ---
        foreach (self::$routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            if (preg_match($route['pattern'], $uri, $matches)) {
                // Remove numeric keys from regex match
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // --- Middleware Execution ---
                $kernel = new \App\Core\Http\Kernel();
                $globalMiddleware = $kernel->getGlobalMiddleware();
                
                // Resolve route middlewares aliases to class names
                $routeMiddleware = array_map(function($alias) use ($kernel) {
                    return $kernel->getRouteMiddleware($alias);
                }, $route['middlewares']);
                
                // Filter out nulls (invalid aliases)
                $routeMiddleware = array_filter($routeMiddleware);

                $allMiddleware = array_merge($globalMiddleware, $routeMiddleware);

                // --- Pipeline Execution ---
                // We pass the parameters as the "request" payload for now, 
                // but ideally we should pass a Request object.
                // For simplicity in this step, we'll pass the params array.
                
                return (new \App\Core\Http\Pipeline())
                    ->send($params) 
                    ->through($allMiddleware)
                    ->then(function ($params) use ($route) {
                        return self::executeAction($route['callback'], $params);
                    });
            }
        }

        // 404 Not Found
        http_response_code(404);
        echo render('errors/404', ['title' => 'Page Not Found']);
    }

    protected static function executeAction($callback, $params)
    {
        // 1. Closure
        if (is_callable($callback)) {
            echo call_user_func_array($callback, $params);
            return;
        }

        // 2. Controller Array: [Controller::class, 'method']
        if (is_array($callback)) {
            [$class, $method] = $callback;
            
            if (!class_exists($class)) {
                throw new \Exception("Controller class $class not found");
            }

            $controller = new $class();
            
            if (!method_exists($controller, $method)) {
                throw new \Exception("Method $method not found in controller $class");
            }

            $result = call_user_func_array([$controller, $method], $params);
            
            if (is_string($result)) {
                echo $result;
            }
        }
    }
}
