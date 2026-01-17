<?php

use App\Core\Bootstrap\Bootstrap;

function view($view, $data = [])
{
    // Kat-3yet l-Bootstrap lli aslan s-lahna fih l-path
    $engine = \App\Core\Bootstrap\Bootstrap::initView();
    echo $engine->render($view, $data);
}


function asset($path)
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    return $protocol . "://" . $host . "/" . ltrim($path, '/');
}

if (!function_exists('db')) {
    function db()
    {
        return Bootstrap::initDatabase();
    }
}

if (!function_exists('dd')) {
    function dd(...$vars)
    {
        echo '<div style="background-color: #18171b; color: #fff; padding: 20px; border-radius: 8px; font-family: monospace; line-height: 1.5; margin: 20px; border-left: 5px solid #ff2d20;">';
        echo '<h2 style="color: #ff2d20; margin-top: 0; font-size: 1.2em;">Die and Dump (Debug)</h2>';

        foreach ($vars as $var) {
            echo '<pre style="background: #232228; padding: 15px; border-radius: 4px; overflow-x: auto; color: #fab005; border: 1px solid #333;">';
            var_dump($var);
            echo '</pre>';
        }

        echo '</div>';
        die();
    }
}
