<?php

namespace App\Core\Http;

/**
 * Class Response
 * Handles sending HTTP responses including headers, status codes, and content.
 */
class Response
{
    /**
     * Send a JSON response to the client.
     * Useful for API development within OptimaCV.
     * * @param mixed $data The data to be encoded as JSON.
     * @param int $statusCode The HTTP status code (default: 200).
     */
    public static function json($data, int $statusCode = 200)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    /**
     * Redirect the user to a specific URL.
     * * @param string $url The destination URL.
     */
    public static function redirect(string $url)
    {
        header("Location: $url");
        exit;
    }

    /**
     * Send a plain text or HTML response.
     * * @param string $content The content to display.
     * @param int $statusCode The HTTP status code (default: 200).
     */
    public static function send(string $content, int $statusCode = 200)
    {
        http_response_code($statusCode);
        echo $content;
        exit;
    }
}