<?php

namespace App\Core\Support\Facades;

use App\Core\Container\Container;
use RuntimeException;

/**
 * Class Facade
 * Provides static access to objects registered in the container.
 */
abstract class Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        throw new RuntimeException('Facade does not implement getFacadeAccessor method.');
    }

    /**
     * Resolve the facade root instance from the container.
     */
    public static function getFacadeRoot()
    {
        return Container::getInstance()->get(static::getFacadeAccessor());
    }

    /**
     * Handle dynamic, static calls to the object.
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();

        if (!$instance) {
            throw new RuntimeException('A facade root has not been set.');
        }

        return $instance->$method(...$args);
    }
}
