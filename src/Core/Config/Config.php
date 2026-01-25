<?php

declare(strict_types=1);

namespace App\Core\Config;

use App\Core\Exceptions\ConfigurationException;

/**
 * Class Config
 * Hardened configuration handler with dot notation support.
 */
class Config
{
    protected static array $config = [];
    protected static string $configPath;

    public static function load(string $path): void
    {
        self::$configPath = $path;
        
        if (!is_dir($path)) {
            throw new ConfigurationException("Configuration directory [{$path}] not found.");
        }

        $files = glob($path . '/*.php');
        if ($files === false) {
             throw new ConfigurationException("Failed to read configuration files from [{$path}].");
        }

        foreach ($files as $file) {
            $key = pathinfo($file, PATHINFO_FILENAME);
            $content = require $file;
            
            if (!is_array($content)) {
                throw new ConfigurationException("Configuration file [{$file}] must return an array.");
            }
            
            self::$config[$key] = $content;
        }
    }

    /**
     * Get a configuration value using dot notation.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $parts = explode('.', $key);
        $data = self::$config;

        foreach ($parts as $part) {
            if (!isset($data[$part])) {
                return $default;
            }
            $data = $data[$part];
        }

        return $data;
    }

    public static function all(): array
    {
        return self::$config;
    }
}
