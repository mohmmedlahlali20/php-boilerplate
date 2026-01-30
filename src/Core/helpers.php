<?php

use App\Core\Bootstrap\Bootstrap;

/**
 * Global helper functions for the OptimaCV Framework.
 */

if (!function_exists('view')) {
    /**
     * @return string
     */
    function view(string $view, array $data = []): string
    {
        // Change from 'echo render' to 'return render'
        return render($view, $data); 
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
        if (!headers_sent()) {
            header('Content-Type: text/html; charset=utf-8');
        }

        echo '<style>
            .dd-container { background: #050505; color: #d1d5db; padding: 40px; font-family: "JetBrains Mono", monospace; min-height: 100vh; }
            .dd-tag { background: #FF003C; color: white; padding: 5px 15px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.2em; font-size: 10px; margin-bottom: 20px; display: inline-block; }
            .dd-header { border-bottom: 1px solid rgba(255, 0, 60, 0.2); margin-bottom: 30px; padding-bottom: 20px; }
            .dd-box { background: #111; border: 1px solid rgba(255, 0, 60, 0.1); padding: 25px; border-radius: 4px; border-left: 4px solid #FF003C; margin-bottom: 20px; overflow-x: auto; box-shadow: 0 20px 50px rgba(0,0,0,0.5); }
            pre { margin: 0; color: #ff6e91; }
        </style>';

        echo '<div class="dd-container">';
        echo '<div class="dd-header">';
        echo '<span class="dd-tag">Soul Inspection</span>';
        echo '<div style="color: #4b5563; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.1em;">Demon Core Engine V6.6.6</div>';
        echo '</div>';

        foreach ($vars as $var) {
            echo '<div class="dd-box"><pre>';
            ob_start();
            var_dump($var);
            echo htmlspecialchars(ob_get_clean());
            echo '</pre></div>';
        }

        echo '<div style="margin-top: 50px; color: #222; font-size: 8px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.5em;">End of Manifestation</div>';
        echo '</div>';
        die();
    }
}

if (!function_exists('csrf_token')) {
    /**
     * Get the current CSRF token.
     * @return string
     */
    function csrf_token(): string
    {
        return \App\Core\Security\Csrf::generate();
    }
}
if (!function_exists('config')) {
    /**
     * Get a configuration value.
     */
    function config(string $key, $default = null)
    {
        return \App\Core\Config\Config::get($key, $default);
    }
}
