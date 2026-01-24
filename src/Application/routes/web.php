<?php

use App\Core\Router\Router;

Router::get('/', function() {
    return render('home', ['title' => 'Welcome to Med Framework']);
});

Router::get('/docs', function() {
    return render('docs', ['title' => 'Documentation']);
});

Router::get('/showcase', function() {
    return render('showcase', ['title' => 'UI Showcase']);
});

