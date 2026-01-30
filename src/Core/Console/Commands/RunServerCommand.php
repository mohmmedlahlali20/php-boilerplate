<?php

namespace App\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RunServerCommand
 * Starts the PHP built-in development server.
 */
class RunServerCommand extends Command
{
    protected function configure()
    {
        $this->setName('run:server')
            ->setDescription('Start the PHP development server');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("<info>Demon Framework server starting on http://localhost:8000</info>");
        $output->writeln("<comment>Press Ctrl+C to stop the server</comment>");

        // Execute the built-in PHP server pointing to the public directory
        passthru("php -S localhost:8000 -t public");

        return Command::SUCCESS;
    }
}