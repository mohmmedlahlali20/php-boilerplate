<?php

use App\Core\Router\Router;
use App\Application\Controllers\SecurityTestController;

Router::get('/', function() {
    return render('home', ['title' => 'Welcome to Demon Framework']);
});

Router::get('/docs', function() {
    return render('docs', ['title' => 'Documentation']);
});

Router::get('/showcase', function() {
    return render('showcase', ['title' => 'UI Showcase']);
});

Router::get('/demon', function() {
    return render('demon', ['title' => 'Demon Framework | Devilish Speed']);
});

// --- Security Lab Routes ---
Router::get('/security-test', [SecurityTestController::class, 'index']);

// Unsafe Route: No middleware attached
Router::post('/security-test/unsafe', [SecurityTestController::class, 'handleUnsafe']);

// Safe Route: Protected by CSRF middleware
Router::post('/security-test/safe', [SecurityTestController::class, 'handleSafe']);

// Admin Route: Protected by Auth middleware
Router::get('/admin', function() {
    return "<h1>Welcome Admin! You are authenticated.</h1>";
})->middleware('auth');
