<?php

namespace App\Core\Router;

/**
 * Class Router
 * * A simple HTTP router that supports GET, POST, PUT, and DELETE methods.
 * It also handles method spoofing for browsers that only support GET/POST.
 */
class Router
{
    /** @var array Holds all registered routes categorized by HTTP method */
    protected static array $routes = [];

    /**
     * Registers a GET route.
     * @param string $uri The path (e.g., '/users')
     * @param array|callable $controller The callback [Controller::class, 'method'] or Closure
     */
    public static function get(string $uri, $controller): void
    {
        self::$routes['GET'][$uri] = $controller;
    }

    /**
     * Registers a POST route.
     */
    public static function post(string $uri, $controller): void
    {
        self::$routes['POST'][$uri] = $controller;
    }

    /**
     * Registers a PUT route (typically for updates).
     */
    public static function put(string $uri, $controller): void
    {
        self::$routes['PUT'][$uri] = $controller;
    }

    /**
     * Registers a DELETE route.
     */
    public static function delete(string $uri, $controller): void
    {
        self::$routes['DELETE'][$uri] = $controller;
    }

    /**
     * Resolves the current request URI and executes the associated controller action.
     * Handles method spoofing for PUT and DELETE via a hidden '_method' field.
     * * @return mixed
     */
    public static function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // 1. Method Spoofing: Check for '_method' in POST data (e.g., <input type="hidden" name="_method" value="PUT">)
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        // 2. Route Check: Verify if the route exists for the given method
        if (!isset(self::$routes[$method][$uri])) {
            return self::abort(404);
        }

        $callback = self::$routes[$method][$uri];

        // 3. Execution: Handle [Controller, Method] arrays
        if (is_array($callback)) {
            [$controllerName, $methodName] = $callback;

            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $methodName)) {
                    return $controller->$methodName();
                }
            }
        }

        // 4. Execution: Handle Closures/Callables
        if (is_callable($callback)) {
            return call_user_func($callback);
        }

        return self::abort(404);
    }

    /**
     * Sets HTTP response code and renders the error view.
     * @param int $code
     * @return mixed
     */
    protected static function abort(int $code = 404)
    {
        http_response_code($code);
        if (function_exists('view')) {
            return view("errors/{$code}", ['title' => "Error {$code}"]);
        }
        die("Error {$code}: Page Not Found");
    }
}