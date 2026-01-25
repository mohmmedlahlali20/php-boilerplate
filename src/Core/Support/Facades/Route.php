<?php

namespace App\Core\Support\Facades;

class Route extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Core\Router\Router::class;
    }
}
