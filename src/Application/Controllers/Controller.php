<?php

namespace App\Application\Controllers;

use App\Core\Bootstrap\Bootstrap;
use App\Core\Security\Csrf;

/**
 * Class Controller
 * Base controller providing view rendering, redirection, and CSRF security.
 */
abstract class Controller
{
    /** @var mixed Cached instance of the template engine */
    protected static $viewEngine = null;

    /**
     * Renders a template view with the provided data.
     * @param string $view
     * @param array $data
     * @return string The rendered HTML
     */
    protected function render(string $view, array $data = []): string
    {
        if (self::$viewEngine === null) {
            self::$viewEngine = Bootstrap::initView();
        }

        // Always inject the current CSRF token into every view for convenience
        $data['csrf_token'] = $this->generateCsrfToken();

        return self::$viewEngine->render($view, $data);
    }

    /**
     * Redirects to a specific URL.
     * @param string $url
     * @return void
     */
    protected function redirect(string $url): void
    {
        header("Location: " . $url);
        exit;
    }

    /**
     * Returns a JSON response.
     * @param mixed $data
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
     * Generates and retrieves the CSRF token.
     * @return string
     */
    protected function generateCsrfToken(): string
    {
        return Csrf::generate();
    }

    /**
     * Validates the CSRF token from the request.
     * @throws \Exception If the token is invalid or missing.
     */
    protected function validateCsrf(): void
    {
        $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';

        if (!Csrf::validate($token)) {
            http_response_code(403);
            die("Security Error: Invalid or missing CSRF token.");
        }
    }
}
