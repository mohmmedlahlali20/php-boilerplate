<?php

declare(strict_types=1);

namespace App\Core\Bootstrap;

use App\Core\Exceptions\ConfigurationException;

/**
 * Class Environment
 * Ensures the runtime environment meets all requirements before booting.
 */
class Environment
{
    protected static array $requiredKeys = [
        'APP_KEY',
        'DB_HOST',
        'DB_NAME',
        'DB_USER'
    ];

    public static function validate(): void
    {
        foreach (self::$requiredKeys as $key) {
            if (empty($_ENV[$key])) {
                throw new ConfigurationException("Missing required environment variable: [{$key}].");
            }
        }
    }
}
