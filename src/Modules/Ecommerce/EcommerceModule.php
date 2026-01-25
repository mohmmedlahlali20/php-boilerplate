<?php

namespace App\Modules\Ecommerce;

use App\Core\Module\Module;
use App\Core\Container\Container;

class EcommerceModule extends Module
{
    protected string $name = 'Ecommerce';

    public function boot(): void
    {
        $container = Container::getInstance();
        
        // Register module specific services here
        // $container->singleton(EcommerceService::class);
    }
}
