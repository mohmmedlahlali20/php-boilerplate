<?php

namespace App\Core\Bootstrap;

use Dotenv\Dotenv;
use App\Core\View\BladeEngine;
use App\Infrastructure\Database;

class Bootstrap
{
    private static $isBooted = false;

    public static function boot()
    {
        if (self::$isBooted) return;

        // 1. Load Environment Variables (.env)
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
        $dotenv->load();

        // 2. Error Reporting config (mzyana f l-development)
        if ($_ENV['APP_DEBUG'] === 'true') {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        } else {
            error_reporting(0);
            ini_set('display_errors', 0);
        }

        self::$isBooted = true;
    }


    // src/Core/Bootstrap/Bootstrap.php
    public static function run()
    {
        self::boot();
        // Loadi l-routes men fichier khariji (bhal Laravel)
        require_once __DIR__ . '/../../../routes/web.php';

        // Executer l-route l-mounasiba
        \App\Core\Router::resolve();
    }

    /**
     * Helper bach t-init l-Blade Engine f ay blassa
     */
    public static function initView()
    {
        $viewsPath = __DIR__ . '/../../../views';
        $cachePath = __DIR__ . '/../../../storage/cache';
        return new BladeEngine($viewsPath, $cachePath);
    }

    /**
     * Helper bach t-loadi l-Database direct
     */
    public static function initDatabase()
    {
        return Database::getInstance()->getConnection();
    }
}
