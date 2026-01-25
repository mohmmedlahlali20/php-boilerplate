<?php

namespace App\Core\Http;

/**
 * Class Response
 * Represents an HTTP response with a Laravel-inspired API.
 */
class Response
{
    protected $content;
    protected int $status;
    protected array $headers;

    public function __construct($content = '', int $status = 200, array $headers = [])
    {
        $this->content = $content;
        $this->status = $status;
        $this->headers = $headers;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function header(string $key, string $value): self
    {
        $this->headers[$key] = $value;
        return $this;
    }

    public function withHeaders(array $headers): self
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    public function json($data, int $status = 200): self
    {
        $this->content = json_encode($data);
        $this->status = $status;
        $this->header('Content-Type', 'application/json');
        return $this;
    }

    public function send(): void
    {
        if (!headers_sent()) {
            http_response_code($this->status);
            foreach ($this->headers as $key => $value) {
                header("$key: $value");
            }
        }

        echo $this->content;
    }

    public function __toString(): string
    {
        return (string) $this->content;
    }
}