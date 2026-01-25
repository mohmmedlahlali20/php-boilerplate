<?php

namespace App\Application\Services;

/**
 * Class Service
 * Base service providing common business logic utilities.
 */
abstract class Service
{
    /**
     * Helper to format standard API/JSON responses.
     */
    protected function formatResponse(bool $success, $data = null, string $message = ""): array
    {
        return [
            'success'   => $success,
            'data'      => $data,
            'message'   => $message,
            'timestamp' => date('Y-m-d H:i:s')
        ];
    }

    /**
     * Common Validation Helper.
     */
    protected function validate(array $data, array $rules): array
    {
        $errors = [];
        foreach ($rules as $field => $rule) {
            if ($rule === 'required' && (!isset($data[$field]) || empty($data[$field]))) {
                $errors[] = "The {$field} field is required.";
            }
        }
        return $errors;
    }

    /**
     * Log actions across all services.
     */
    protected function log(string $message, string $level = 'info'): void
    {
        $logDir = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'logs';
        
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        $logFile = $logDir . DIRECTORY_SEPARATOR . 'app.log';
        $logEntry = "[" . date('Y-m-d H:i:s') . "] [" . strtoupper($level) . "]: $message" . PHP_EOL;
        
        file_put_contents($logFile, $logEntry, FILE_APPEND);
    }
}