<?php

namespace App\Core\Support;

class Event
{
    private static array $listeners = [];

    public static function listen(string $event, callable $callback): void
    {
        self::$listeners[$event][] = $callback;
    }

    public static function dispatch(string $event, mixed $payload = null): void
    {
        if (!isset(self::$listeners[$event])) {
            return;
        }

        foreach (self::$listeners[$event] as $listener) {
            $listener($payload);
        }
    }
}
