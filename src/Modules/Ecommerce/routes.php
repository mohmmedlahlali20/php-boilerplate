<?php

use App\Core\Router\Router;
use App\Modules\Ecommerce\Controllers\EcommerceController;

Router::get('/ecommerce', [EcommerceController::class, 'index']);
