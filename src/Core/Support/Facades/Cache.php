<?php

namespace App\Core\Support\Facades;

class Cache extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Core\Support\Cache::class;
    }
}
