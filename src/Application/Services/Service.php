<?php

namespace App\Application\Services;

abstract class Service
{
    /**
     * Helper to format standard API/JSON responses
     */
    protected function formatResponse(bool $success, $data = null, string $message = ""): array
    {
        return [
            'success' => $success,
            'data'    => $data,
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s')
        ];
    }

    /**
     * Common Validation Helper (Example)
     */
    protected function validate(array $data, array $rules): bool
    {
        foreach ($rules as $field => $rule) {
            if ($rule === 'required' && (!isset($data[$field]) || empty($data[$field]))) {
                return false;
            }
        }
        return true;
    }

    /**
     * Log actions across all services
     */
    protected function log(string $message, string $level = 'info'): void
    {
        // Logic to write to storage/logs/app.log
        $logEntry = "[" . date('Y-m-d H:i:s') . "] [$level]: $message" . PHP_EOL;
        file_put_contents(__DIR__ . '/../../../storage/logs/app.log', $logEntry, FILE_APPEND);
    }
}