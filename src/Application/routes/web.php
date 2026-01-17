<?php

use App\Core\Router\Router;
use App\Application\Controllers\UserController;

Router::get('/test-users', [UserController::class, 'index']);