<?php

namespace App\Core\Providers;

use App\Infrastructure\Database;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->container->singleton(\PDO::class, function() {
            return Database::getInstance()->getConnection();
        });
    }

    public function boot(): void
    {
        // Set the global connection for the Active Record system
        \App\Core\Database\Model::setConnection($this->container->get(\PDO::class));
    }
}
