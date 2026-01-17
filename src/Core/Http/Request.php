<?php

namespace App\Core\Http;

/**
 * Class Request
 * Provides a clean interface for interacting with the current HTTP request.
 */
class Request
{
    /**
     * Get the current request URI path.
     * @return string
     */
    public static function uri(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    /**
     * Get the HTTP request method (GET, POST, etc.).
     * @return string
     */
    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Get all input data from GET and POST requests.
     * Useful for handling form submissions in OptimaCV.
     * @return array
     */
    public static function all(): array
    {
        return array_merge($_GET, $_POST, json_decode(file_get_contents('php://input'), true) ?? []);
    }

    /**
     * Get a specific input value by key.
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function input(string $key, $default = null)
    {
        $data = self::all();
        return $data[$key] ?? $default;
    }

    /**
     * Check if the request is an AJAX request.
     * @return bool
     */
    public static function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    /**
     * Retrieve a specific header value.
     * @param string $key
     * @return string|null
     */
    public static function header(string $key): ?string
    {
        $headers = getallheaders();
        return $headers[$key] ?? $headers[ucfirst($key)] ?? null;
    }
}