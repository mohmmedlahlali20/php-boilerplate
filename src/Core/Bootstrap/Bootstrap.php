<?php

namespace App\Core\Bootstrap;

use Dotenv\Dotenv;
use App\Core\View\BladeEngine;
use App\Infrastructure\Database;
use App\Core\Router\Router;
use App\Core\Container\Container;
use App\Core\Config\Config;

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

        self::$basePath = realpath(dirname(__DIR__, 3));

        // Load .env from the project root
        $dotenv = Dotenv::createImmutable(self::$basePath);
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

        // Load Configuration
        Config::load(self::$basePath . DIRECTORY_SEPARATOR . 'config');

        // Initialize Cache
        \App\Core\Support\Cache::init(self::$basePath . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'cache');

        self::$isBooted = true;
    }

    /**
     * Executes the application lifecycle.
     */
    public static function run()
    {
        set_exception_handler([\App\Core\Exceptions\ExceptionHandler::class, 'handle']);

        try {
            self::boot();
            
            // Validate environment
            \App\Core\Bootstrap\Environment::validate();

            // Initialize Container
            $container = Container::getInstance();

            // Load Service Providers from Config
            self::loadProviders($container);

            // Discover and Load Modules
            self::loadModules($container);

            // Load Routes
            $routesPath = self::$basePath . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'web.php';
            if (file_exists($routesPath)) {
                require_once $routesPath;
            }

            Router::resolve();
        } catch (\Throwable $e) {
            \App\Core\Exceptions\ExceptionHandler::handle($e);
        }
    }

    /**
     * Load all service providers defined in the configuration.
     */
    private static function loadProviders($container): void
    {
        $providers = config('app.providers', []);
        $instances = [];

        foreach ($providers as $providerClass) {
            if (class_exists($providerClass)) {
                $provider = new $providerClass($container);
                if ($provider instanceof \App\Core\Providers\ServiceProvider) {
                    $provider->register();
                    $instances[] = $provider;
                }
            }
        }

        foreach ($instances as $instance) {
            $instance->boot();
        }
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

    public static function initView()
    {
        if (!self::$isBooted) self::boot();

        $viewsPath = self::$basePath . DIRECTORY_SEPARATOR . 'views';
        $cachePath = self::$basePath . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'cache';

        return new BladeEngine($viewsPath, $cachePath);
    }

    public static function initDatabase()
    {
        return Database::getInstance()->getConnection();
    }
    
    public static function getBasePath(): string
    {
        return self::$basePath;
    }
}
