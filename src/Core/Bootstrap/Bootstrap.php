<?php

namespace App\Core\Bootstrap;

use Dotenv\Dotenv;
use App\Core\View\BladeEngine;
use App\Infrastructure\Database;
use App\Core\Router\Router;

class Bootstrap
{
    private static $isBooted = false;
    private static $basePath;

    public static function boot()
    {
        if (self::$isBooted) return;

        // dirname(__DIR__, 3) ghat-rj3ek men src/Core/Bootstrap direct l-PHP_structer
        self::$basePath = realpath(dirname(__DIR__, 3));

        // Daba .env ghadi i-t-loda men PHP_structer/.env
        $dotenv = \Dotenv\Dotenv::createImmutable(self::$basePath);
        $dotenv->load();

        $debug = $_ENV['APP_DEBUG'] ?? 'false';

        if ($debug === 'true') {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        } else {
            error_reporting(0);
            ini_set('display_errors', 0);
        }

        self::$isBooted = true;
    }

    public static function run()
    {
        self::boot();

        // Loadi l-routes men l-path s7i7 (PHP_structer/routes/web.php)
        // Check ila knti dayr routes dakhil src aw l-root
        $routesPath = self::$basePath . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'web.php';

        if (file_exists($routesPath)) {
            require_once $routesPath;
        } else {
            // Ila kant routes dakhil src/Application/routes/
            require_once self::$basePath . '/src/Application/routes/web.php';
        }

        Router::resolve();
    }

    public static function initView()
    {
        if (!self::$isBooted) self::boot();

        // Daba l-paths ghadi i-kouno dima s7a7
        $viewsPath = self::$basePath . DIRECTORY_SEPARATOR . 'views';
        $cachePath = self::$basePath . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'cache';

        return new BladeEngine($viewsPath, $cachePath);
    }

    public static function initDatabase()
    {
        return Database::getInstance()->getConnection();
    }
}
