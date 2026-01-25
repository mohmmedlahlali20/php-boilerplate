<?php

namespace App\Core\Providers;

use App\Core\Container\Container;

/**
 * Class ServiceProvider
 * Abstract base class for all service providers.
 */
abstract class ServiceProvider
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Register any application services.
     */
    abstract public function register(): void;

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Default empty boot method
    }
}
