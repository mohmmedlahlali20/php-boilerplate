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

        $this->container->singleton(\App\Core\Database\DatabaseManager::class, function($c) {
            return new \App\Core\Database\DatabaseManager($c->get(\PDO::class));
        });
    }

    public function boot(): void
    {
        $pdo = $this->container->get(\PDO::class);
        \App\Core\Database\Model::setConnection($pdo);
        \App\Core\Database\DatabaseManager::setInstance($this->container->get(\App\Core\Database\DatabaseManager::class));
    }
}
