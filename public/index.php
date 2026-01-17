<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Bootstrap\Bootstrap;

// Lansi l-common code (Env, Error handling...)
Bootstrap::boot();

// Exemple dyal usage:
$db = Bootstrap::initDatabase();
$view = Bootstrap::initView();

echo $view->render('home', ['name' => 'Mohammed']);