<?php

namespace App\Core\Support;

class Cache
{
    private static string $cachePath;

    public static function init(string $path): void
    {
        self::$cachePath = $path;
        if (!is_dir(self::$cachePath)) {
            mkdir(self::$cachePath, 0777, true);
        }
    }

    public static function set(string $key, mixed $value, int $ttl = 3600): bool
    {
        $file = self::getFilePath($key);
        $data = [
            'expires_at' => time() + $ttl,
            'value' => serialize($value)
        ];
        return file_put_contents($file, json_encode($data)) !== false;
    }

    public static function get(string $key): mixed
    {
        $file = self::getFilePath($key);
        if (!file_exists($file)) {
            return null;
        }

        $data = json_decode(file_get_contents($file), true);
        if (time() > $data['expires_at']) {
            unlink($file);
            return null;
        }

        return unserialize($data['value']);
    }

    public static function has(string $key): bool
    {
        return self::get($key) !== null;
    }

    public static function forget(string $key): void
    {
        $file = self::getFilePath($key);
        if (file_exists($file)) {
            unlink($file);
        }
    }

    public static function flush(): void
    {
        $files = glob(self::$cachePath . '/*.cache');
        foreach ($files as $file) {
            unlink($file);
        }
    }

    private static function getFilePath(string $key): string
    {
        return self::$cachePath . DIRECTORY_SEPARATOR . md5($key) . '.cache';
    }
}
