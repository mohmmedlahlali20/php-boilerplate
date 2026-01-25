<?php

namespace App\Core\Bootstrap;

use Dotenv\Dotenv;
use App\Core\View\BladeEngine;
use App\Infrastructure\Database;
use App\Core\Router\Router;
use App\Core\Container\Container;

/**
 * Class Bootstrap
 * Responsible for initializing the framework environment and core components.
 */
class Bootstrap
{
    private static $isBooted = false;
    private static $basePath;

    /**
     * Bootstraps the application by loading environment variables and setting error levels.
     */
    public static function boot()
    {
        if (self::$isBooted) return;

        // dirname(__DIR__, 3) returns from src/Core/Bootstrap to the project root
        self::$basePath = realpath(dirname(__DIR__, 3));

        // Load .env from the project root
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

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        self::$isBooted = true;
    }

    /**
     * Executes the application lifecycle: booting, loading routes, and resolving the request.
     */
    public static function run()
    {
        // Initialize Container
        $container = Container::getInstance();

        // Discover and Load Modules
        self::loadModules($container);

        // Locates routes in the /routes/web.php file
        $routesPath = self::$basePath . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'web.php';

        if (file_exists($routesPath)) {
            require_once $routesPath;
        } else {
            // Fallback for alternative route location
            $legacyRoutes = self::$basePath . '/src/Application/routes/web.php';
            if (file_exists($legacyRoutes)) {
                require_once $legacyRoutes;
            }
        }

        Router::resolve();
    }

    /**
     * Auto-discover and boot modules in src/Modules
     */
    private static function loadModules($container): void
    {
        $modulesPath = self::$basePath . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Modules';
        
        if (!is_dir($modulesPath)) {
            return;
        }

        $directories = scandir($modulesPath);

        foreach ($directories as $directory) {
            if ($directory === '.' || $directory === '..') {
                continue;
            }

            $moduleDir = $modulesPath . DIRECTORY_SEPARATOR . $directory;
            if (!is_dir($moduleDir)) {
                continue;
            }

            $moduleClass = "App\\Modules\\$directory\\{$directory}Module";
            
            if (class_exists($moduleClass)) {
                $module = new $moduleClass($moduleDir);
                if ($module instanceof \App\Core\Module\Module) {
                    $module->boot();
                    $module->registerRoutes();
                }
            }
        }
    }

    /**
     * Initializes and returns the Blade Template Engine instance.
     * @return BladeEngine
     */
    public static function initView()
    {
        if (!self::$isBooted) self::boot();

        $viewsPath = self::$basePath . DIRECTORY_SEPARATOR . 'views';
        $cachePath = self::$basePath . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'cache';

        return new BladeEngine($viewsPath, $cachePath);
    }



    /**
     * Global helper for rendering views using the Bootstrap View Engine.
     * @param string $view
     * @param array $data
     * @return string
     */
    function render(string $view, array $data = []): string
    {
        return \App\Core\Bootstrap\Bootstrap::initView()->render($view, $data);
    }

    /**
     * Retrieves the singleton database connection instance.
     * @return \PDO
     */
    public static function initDatabase()
    {
        return Database::getInstance()->getConnection();
    }
}
