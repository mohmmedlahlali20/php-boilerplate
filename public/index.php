<?php
require_once __DIR__ . '/../vendor/autoload.php';
// 1. Load helpers from src/Core
require_once __DIR__ . '/../src/Core/helpers.php'; 

// 2. Load routes from src/Application/routes
require_once __DIR__ . '/../src/Application/routes/web.php'; 
use App\Core\Router\Router;

// 3. Resolve the request
Router::resolve();