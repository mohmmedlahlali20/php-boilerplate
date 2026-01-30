<?php

namespace App\Core\Support\Facades;

class Event extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Core\Support\Event::class;
    }
}
