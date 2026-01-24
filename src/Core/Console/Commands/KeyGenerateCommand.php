<?php

namespace App\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class KeyGenerateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('key:generate')
            ->setDescription('Set the application key');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $key = bin2hex(random_bytes(32));

        $envFile = __DIR__ . '/../../../../.env';
        
        if (!file_exists($envFile)) {
            $io->error('.env file not found. Copy .env.example to .env first.');
            return Command::FAILURE;
        }

        $content = file_get_contents($envFile);

        // Check if APP_KEY exists
        if (preg_match('/^APP_KEY=/m', $content)) {
            // Replace existing key
            $content = preg_replace('/^APP_KEY=.*$/m', 'APP_KEY=' . $key, $content);
        } else {
            // Append key if not present
            $content .= "\nAPP_KEY=" . $key;
        }

        file_put_contents($envFile, $content);

        $io->success("Application key set successfully: " . $key);
        return Command::SUCCESS;
    }
}
