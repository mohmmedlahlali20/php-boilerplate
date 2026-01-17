<?php
namespace App\Core;

class Router {
    protected static $routes = [];

    public static function get($uri, $controller) {
        self::$routes['GET'][$uri] = $controller;
    }

    public static function post($uri, $controller) {
        self::$routes['POST'][$uri] = $controller;
    }

    

    // T9der t-zid put o delete b-nafs l-mantiq
    
    public static function resolve() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Check ila l-method dyal l-form fih _method (bach t-supporti PUT/DELETE)
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        if (isset(self::$routes[$method][$uri])) {
            $callback = self::$routes[$method][$uri];

            if (is_array($callback)) {
                // [ControllerClass, MethodName]
                $controller = new $callback[0]();
                return $controller->{$callback[1]}();
            }
            
            return call_user_func($callback);
        }

        http_response_code(404);
        echo "404 - Page Not Found";
    }
}