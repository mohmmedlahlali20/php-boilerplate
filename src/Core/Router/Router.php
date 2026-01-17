<?php

namespace App\Core\Router;

class Router {
    protected static $routes = [];

    public static function load($file) {
        require $file;
        return new static;
    }

    public static function get($uri, $controller) {
        self::$routes['GET'][$uri] = $controller;
    }

    public static function post($uri, $controller) {
        self::$routes['POST'][$uri] = $controller;
    }

    public static function resolve() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        if (isset(self::$routes[$method][$uri])) {
            $callback = self::$routes[$method][$uri];

            if (is_array($callback)) {
                $controllerName = $callback[0];
                $methodName = $callback[1];
                
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    return $controller->$methodName();
                }
            }
            
            return call_user_func($callback);
        }

        http_response_code(404);
        echo "404 - Page Not Found";
    }
}