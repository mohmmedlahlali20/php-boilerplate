<?php

namespace App\Core\Support\Facades;

class DB extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Core\Database\DatabaseManager::class;
    }
}
