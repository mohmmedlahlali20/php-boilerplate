<?php

namespace App\Core\Http;

/**
 * Class Request
 * Represents the current HTTP request with a Laravel-inspired API.
 */
class Request
{
    protected array $data;
    protected array $server;
    protected array $files;
    protected array $cookies;
    protected array $headers;

    public function __construct()
    {
        $this->server = $_SERVER;
        $this->files = $_FILES;
        $this->cookies = $_COOKIE;
        $this->headers = $this->extractHeaders();
        $this->data = $this->extractData();
    }

    protected function extractHeaders(): array
    {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (str_starts_with($key, 'HTTP_')) {
                $name = str_replace('_', '-', strtolower(substr($key, 5)));
                $headers[$name] = $value;
            }
        }
        return $headers;
    }

    protected function extractData(): array
    {
        return array_merge(
            $_GET, 
            $_POST, 
            json_decode(file_get_contents('php://input'), true) ?? []
        );
    }

    public function all(): array
    {
        return $this->data;
    }

    public function input(string $key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public function only(array $keys): array
    {
        return array_intersect_key($this->data, array_flip($keys));
    }

    public function except(array $keys): array
    {
        return array_diff_key($this->data, array_flip($keys));
    }

    public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }

    public function method(): string
    {
        return strtoupper($this->server['REQUEST_METHOD'] ?? 'GET');
    }

    public function uri(): string
    {
        return parse_url($this->server['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    }

    public function isMethod(string $method): bool
    {
        return $this->method() === strtoupper($method);
    }

    public function header(string $key, $default = null)
    {
        return $this->headers[strtolower($key)] ?? $default;
    }

    public function ip(): ?string
    {
        return $this->server['REMOTE_ADDR'] ?? null;
    }

    public function isJson(): bool
    {
        return str_contains($this->header('Content-Type', ''), 'application/json');
    }

    public function file(string $key)
    {
        return $this->files[$key] ?? null;
    }
}