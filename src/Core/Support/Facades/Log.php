<?php

declare(strict_types=1);

namespace App\Core\Support\Facades;

/**
 * @method static void info(string $message, array $context = [])
 * @method static void error(string $message, array $context = [])
 * @method static void warning(string $message, array $context = [])
 */
class Log extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Core\Support\Logger::class;
    }
}
