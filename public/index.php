<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Bootstrap\Bootstrap;
use App\Core\Router\Router;

Bootstrap::boot();

// Test i-welli bhal haka:
if (!class_exists(Router::class)) {
    echo "Class Router not found! Check file name casing in src/Core/Router/Router.php";
    die();
}

// Loadi l-routes dyalk (hit l-Router dba khawi)
Router::load(__DIR__ . '/../src/Application/routes/web.php')::resolve();