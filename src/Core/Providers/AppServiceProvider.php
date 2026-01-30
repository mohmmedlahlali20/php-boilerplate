<?php

namespace App\Core\Providers;

use App\Core\Bootstrap\Bootstrap;
use App\Core\Router\Router;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind the PDO connection
        $this->container->singleton(\PDO::class, function() {
            return Bootstrap::initDatabase();
        });

        // Bind the DatabaseManager
        $this->container->singleton(\App\Core\Database\DatabaseManager::class, function() {
            return new \App\Core\Database\DatabaseManager($this->container->get(\PDO::class));
        });

        // Bind the request
        $this->container->singleton(\App\Core\Http\Request::class, function() {
            return new \App\Core\Http\Request();
        });

        // Bind the Logger
        $this->container->singleton(\App\Core\Support\Logger::class, function() {
            $logPath = \App\Core\Bootstrap\Bootstrap::getBasePath() . '/storage/logs/app.log';
            return new \App\Core\Support\Logger($logPath);
        });

        // Bind the router
        $this->container->singleton(Router::class, function() {
            return new Router();
        });

        // Bind the Cache
        $this->container->singleton(\App\Core\Support\Cache::class, function() {
            return new \App\Core\Support\Cache();
        });

        // Bind the Event
        $this->container->singleton(\App\Core\Support\Event::class, function() {
            return new \App\Core\Support\Event();
        });
    }

    public function boot(): void
    {
        // Perform boot actions
    }
}
