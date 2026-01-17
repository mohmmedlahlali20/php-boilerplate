<?php

namespace App\Application\Controllers;

use App\Core\Bootstrap\Bootstrap;

/**
 * Class Controller
 * * Base controller providing view rendering, redirection, and CSRF security.
 */
abstract class Controller
{
    /** @var mixed Cached instance of the template engine */
    protected static $viewEngine = null;

    /**
     * Controller constructor.
     * Automatically validates CSRF tokens for all POST requests.
     */
    public function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrf();
        }
    }

    /**
     * Renders a template view with the provided data.
     * * @param string $view
     * @param array $data
     * @return void
     */
    protected function render(string $view, array $data = []): void
    {
        if (self::$viewEngine === null) {
            self::$viewEngine = Bootstrap::initView();
        }

        // Always inject the current CSRF token into every view for convenience
        $data['csrf_token'] = $this->generateCsrfToken();

        echo self::$viewEngine->render($view, $data);
    }

    /**
     * Redirects to a specific URL.
     * * @param string $url
     * @return void
     */
    protected function redirect(string $url): void
    {
        header("Location: " . $url);
        exit;
    }

    /**
     * Returns a JSON response.
     * * @param mixed $data
     * @param int $status
     * @return void
     */
    protected function json($data, int $status = 200): void
    {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }

    /**
     * Generates and retrieves the CSRF token from the session.
     * * @return string
     */
    protected function generateCsrfToken(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Validates the CSRF token from the POST request.
     * * @throws \Exception If the token is invalid or missing.
     */
    protected function validateCsrf(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $token = $_POST['csrf_token'] ?? '';

        if (empty($token) || $token !== ($_SESSION['csrf_token'] ?? '')) {
            http_response_code(403);
            die("Security Error: Invalid or missing CSRF token.");
        }
    }
}