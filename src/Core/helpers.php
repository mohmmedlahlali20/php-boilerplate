<?php

use App\Core\Bootstrap\Bootstrap;

/**
 * Global helper functions for the OptimaCV Framework.
 */

if (!function_exists('view')) {
    /**
     * Renders a view using the BladeEngine initialized in Bootstrap.
     * * @param string $view Name of the view file (without .med.php)
     * @param array $data Associative array of data to pass to the view
     * @return void
     */
    function view(string $view, array $data = []): void
    {
        $engine = Bootstrap::initView();
        echo $engine->render($view, $data);
    }
}


if (!function_exists('render')) {
    /**
     * Global helper to render a view using the Blade Engine.
     * * @param string $view
     * @param array $data
     * @return string
     */
    function render(string $view, array $data = []): string
    {
        return Bootstrap::initView()->render($view, $data);
    }
}

if (!function_exists('asset')) {
    /**
     * Generates a full URL for public assets (CSS, JS, Images).
     * * @param string $path Path relative to the public directory
     * @return string Full URL
     */
    function asset(string $path): string
    {
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        return $protocol . "://" . $host . "/" . ltrim($path, '/');
    }
}

if (!function_exists('flash')) {
    /**
     * Sets or retrieves flash messages from the session.
     * Messages are deleted automatically after being read once.
     * * @param string $key The session key (e.g., 'success', 'error')
     * @param string|null $message The message to store. If null, retrieves the message.
     * @return string|null
     */
    function flash(string $key, ?string $message = null): ?string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($message !== null) {
            $_SESSION['_flash'][$key] = $message;
            return null;
        }

        if (isset($_SESSION['_flash'][$key])) {
            $msg = $_SESSION['_flash'][$key];
            unset($_SESSION['_flash'][$key]);
            return $msg;
        }

        return null;
    }
}

if (!function_exists('db')) {
    /**
     * Returns the active PDO database connection.
     * * @return \PDO
     */
    function db(): \PDO
    {
        return Bootstrap::initDatabase();
    }
}

if (!function_exists('dd')) {
    /**
     * "Die and Dump" - Debugging helper to inspect variables and stop execution.
     * Styled for better readability.
     * * @param mixed ...$vars One or more variables to inspect
     * @return void
     */
    function dd(...$vars): void
    {
        echo '<div style="background-color: #1a1a1a; color: #ececec; padding: 25px; border-radius: 10px; font-family: \'Fira Code\', monospace; line-height: 1.6; margin: 20px; border: 1px solid #333; box-shadow: 0 4px 15px rgba(0,0,0,0.5);">';
        echo '<div style="display: flex; align-items: center; margin-bottom: 15px;">';
        echo '<span style="background: #ff2d20; color: white; padding: 4px 10px; border-radius: 4px; font-weight: bold; margin-right: 10px;">DEBUG</span>';
        echo '<small style="color: #666;">die dump Debugger</small>';
        echo '</div>';

        foreach ($vars as $var) {
            echo '<pre style="background: #000; padding: 15px; border-radius: 6px; overflow-x: auto; color: #4ade80; border: 1px solid #222; margin-bottom: 10px;">';
            // Using htmlspecialchars to prevent rendering HTML tags inside the dump
            ob_start();
            var_dump($var);
            echo htmlspecialchars(ob_get_clean());
            echo '</pre>';
        }

        echo '</div>';
        die();
    }
}
