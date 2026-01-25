<?php

namespace App\Core\Router;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Container\Container;

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
        $container = Container::getInstance();
        $request = $container->get(Request::class);
        $uri = $request->uri();
        $method = strtolower($request->method());

        // --- Iteration & Matching ---
        foreach (self::$routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            if (preg_match($route['pattern'], $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // --- Middleware Execution ---
                $kernel = new \App\Core\Http\Kernel();
                $globalMiddleware = $kernel->getGlobalMiddleware();
                
                $routeMiddleware = array_map(function($alias) use ($kernel) {
                    return $kernel->getRouteMiddleware($alias);
                }, $route['middlewares']);
                
                $allMiddleware = array_merge($globalMiddleware, array_filter($routeMiddleware));

                // --- Pipeline Execution ---
                return (new \App\Core\Http\Pipeline())
                    ->send($request) 
                    ->through($allMiddleware)
                    ->then(function ($request) use ($route, $params) {
                        return self::executeAction($route['callback'], $request, $params);
                    });
            }
        }

        // 404 Not Found
        http_response_code(404);
        echo render('errors/404', ['title' => 'Page Not Found']);
    }

    protected static function executeAction($callback, $request, $params)
    {
        // 1. Closure
        if (is_callable($callback)) {
            $result = call_user_func_array($callback, array_merge([$request], $params));
            return self::handleResult($result);
        }

        // 2. Controller Array: [Controller::class, 'method']
        if (is_array($callback)) {
            [$class, $method] = $callback;
            
            if (!class_exists($class)) {
                throw new \Exception("Controller class $class not found");
            }

            $container = Container::getInstance();
            $controller = $container->get($class);
            
            if (!method_exists($controller, $method)) {
                throw new \Exception("Method $method not found in controller $class");
            }

            $result = call_user_func_array([$controller, $method], array_merge([$request], $params));
            return self::handleResult($result);
        }
    }

    protected static function handleResult($result)
    {
        if ($result instanceof Response) {
            return $result->send();
        }

        if (is_string($result)) {
            echo $result;
        }

        if (is_array($result) || is_object($result)) {
            header('Content-Type: application/json');
            echo json_encode($result);
        }
    }
}
