<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

use Throwable;
use App\Core\Support\Facades\Log;

/**
 * Class ExceptionHandler
 * Orchestrates global exception handling and logging.
 */
class ExceptionHandler
{
    public static function handle(Throwable $e): void
    {
        $debug = config('app.debug', false);

        // Log the error
        try {
            Log::error($e->getMessage(), [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
        } catch (Throwable $logError) {
            // Fallback if Logger fails
            error_log($e->getMessage());
        }

        if (PHP_SAPI === 'cli') {
            self::renderCli($e);
            return;
        }

        self::renderHttp($e, (bool)$debug);
    }

    protected static function renderHttp(Throwable $e, bool $debug): void
    {
        if (!headers_sent()) {
            http_response_code(500);
        }

        if ($debug) {
            echo "<h1>Unhandled Exception</h1>";
            echo "<h2>" . get_class($e) . ": " . $e->getMessage() . "</h2>";
            echo "<pre>" . $e->getTraceAsString() . "</pre>";
        } else {
            echo "<h1>500 Internal Server Error</h1>";
            echo "<p>Something went wrong on our end. Please try again later.</p>";
        }
    }

    protected static function renderCli(Throwable $e): void
    {
        fwrite(STDERR, "Error: " . $e->getMessage() . PHP_EOL);
        fwrite(STDERR, "File: " . $e->getFile() . ":" . $e->getLine() . PHP_EOL);
    }
}
