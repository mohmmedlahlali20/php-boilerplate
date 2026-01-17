<?php

use App\Core\Router\Router;
use App\Core\Bootstrap\Bootstrap;
// use App\Application\Controllers\UserController;

// Router::get('getAllUsers', [UserController::class, 'index']);
Router::get('/', function() {
    return dd('tir bzkk');
});