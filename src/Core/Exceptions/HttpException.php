<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

/**
 * Class HttpException
 * Thrown during HTTP request or response processing.
 */
class HttpException extends FrameworkException
{
    protected int $statusCode;

    public function __construct(string $message = "", int $statusCode = 500, ?\Throwable $previous = null)
    {
        parent::__construct($message, $statusCode, $previous);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
