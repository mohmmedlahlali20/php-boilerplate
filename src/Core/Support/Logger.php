<?php

declare(strict_types=1);

namespace App\Core\Support;

/**
 * Class Logger
 * A professional, file-based logger for the framework.
 */
class Logger
{
    protected string $logPath;

    public function __construct(string $logPath)
    {
        $this->logPath = $logPath;
        if (!is_dir(dirname($logPath))) {
            mkdir(dirname($logPath), 0755, true);
        }
    }

    public function info(string $message, array $context = []): void
    {
        $this->log('INFO', $message, $context);
    }

    public function error(string $message, array $context = []): void
    {
        $this->log('ERROR', $message, $context);
    }

    public function warning(string $message, array $context = []): void
    {
        $this->log('WARNING', $message, $context);
    }

    protected function log(string $level, string $message, array $context = []): void
    {
        $date = date('Y-m-d H:i:s');
        $jsonContext = !empty($context) ? ' ' . json_encode($context) : '';
        $formatted = "[{$date}] [{$level}]: {$message}{$jsonContext}" . PHP_EOL;

        file_put_contents($this->logPath, $formatted, FILE_APPEND);
    }
}
