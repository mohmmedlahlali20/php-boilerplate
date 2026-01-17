<?php

namespace App\Core\Router;

class Router
{
    protected static $routes = [];

    public static function get($uri, $controller)
    {
        self::$routes['GET'][$uri] = $controller;
    }

    public static function post($uri, $controller)
    {
        self::$routes['POST'][$uri] = $controller;
    }

    public static function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // 1. Handling dyal Method Spoofing (PUT/DELETE)
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        // 2. Check ila l-route kany f l-array dyalna
        if (!isset(self::$routes[$method][$uri])) {
            http_response_code(404);
            // Had l-view errors/404 khass t-kon dertiha f views/errors/404.med.php
            return view('errors/404', ['title' => 'Page Not Found']);
        }

        $callback = self::$routes[$method][$uri];

        // 3. Execute l-Controller o l-Method
        if (is_array($callback)) {
            [$controllerName, $methodName] = $callback;

            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $methodName)) {
                    return $controller->$methodName();
                }
            }
        }

        // 4. Fallback l-Closures (ila knti dayr callable f routes)
        if (is_callable($callback)) {
            return call_user_func($callback);
        }

        // Final fallback 404
        http_response_code(404);
        return view('errors/404', ['title' => 'Error']);
    }
}