<?php

// src/Application/Middlewares/MiddlewareInterface.php
namespace App\Application\Middlewares;

interface MiddlewareInterface
{
    public function handle($request, callable $next);
}
