<?php

namespace App\Core\Module;

use App\Core\Router\Router;

/**
 * Class Module
 * Base class for all application modules.
 */
abstract class Module
{
    protected string $name;
    protected string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Boot the module. Called during application bootstrap.
     */
    abstract public function boot(): void;

    /**
     * Register routes for the module.
     */
    public function registerRoutes(): void
    {
        $routesFile = $this->path . DIRECTORY_SEPARATOR . 'routes.php';
        if (file_exists($routesFile)) {
            require $routesFile;
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
