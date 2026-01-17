<?php

namespace App\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateCommand extends Command
{
    protected function configure()
    {
        $this->setName('migrate')
            ->setDescription('Run all pending migrations');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $baseMigration = __DIR__ . '/../../../Infrastructure/Migrations/Migration.php';
        if (file_exists($baseMigration)) {
            require_once $baseMigration;
        }
        // 1. Get all migration files
        $path = __DIR__ . '/../../../Infrastructure/Migrations/';
        $files = glob($path . '*.php');
        if (empty($files)) {
            $output->writeln("<info>No migrations found.</info>");
            return Command::SUCCESS;
        }

        foreach ($files as $file) {
            if (basename($file) === 'Migration.php') continue;

            require_once $file;

            $filename = pathinfo($file, PATHINFO_FILENAME);
            $className = 'Migration_' . $filename;

            if (class_exists($className)) {
                $output->writeln("<comment>Migrating: {$filename}...</comment>");

                $migration = new $className();
                $migration->up();

                $output->writeln("<info>Migrated: {$filename} ✅</info>");
            }
        }

        $output->writeln("<info>Database is up to date!</info>");
        return Command::SUCCESS;
    }
}
