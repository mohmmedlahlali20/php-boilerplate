<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Bootstrap\Bootstrap;
use App\Core\Router\Router;

Bootstrap::boot();

if (!class_exists(Router::class)) {
    echo "Class Router not found! Check file name casing in src/Core/Router/Router.php";
    die();
}

Bootstrap::run();