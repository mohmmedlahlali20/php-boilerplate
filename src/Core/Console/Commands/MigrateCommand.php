<?php

namespace App\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class MigrateCommand
 * Scans the migrations directory and executes all pending database schema changes.
 */
class MigrateCommand extends Command
{
    /**
     * Configures the command name and providing a clear description for the CLI.
     */
    protected function configure()
    {
        $this->setName('migrate')
            ->setDescription('Run all pending migrations');
    }

    /**
     * Executes the migration process.
     * * @param InputInterface $input
     * @param OutputInterface $output
     * @return int Command success status
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /**
         * Load the Base Migration class first to ensure child classes can extend it.
         * This prevents 'Class not found' errors during the dynamic require process.
         */
        $baseMigration = __DIR__ . '/../../../Infrastructure/Migrations/Migration.php';
        if (file_exists($baseMigration)) {
            require_once $baseMigration;
        }

        // Scan the directory for all PHP migration files
        $path = __DIR__ . '/../../../Infrastructure/Migrations/';
        $files = glob($path . '*.php');
        
        if (empty($files)) {
            $output->writeln("<info>No migrations found.</info>");
            return Command::SUCCESS;
        }

        

        foreach ($files as $file) {
            // Skip the abstract base class file
            if (basename($file) === 'Migration.php') continue;

            // Dynamically include the migration file
            require_once $file;

            /**
             * Construct the class name based on the filename convention.
             * Format: Migration_YYYY_MM_DD_HHMMSS_name
             */
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $className = 'Migration_' . $filename;

            if (class_exists($className)) {
                $output->writeln("<comment>Migrating: {$filename}...</comment>");

                // Instantiate the migration and trigger the up() method
                $migration = new $className();
                $migration->up();

                $output->writeln("<info>Migrated: {$filename} </info>");
            }
        }

        $output->writeln("<info>Database is up to date!</info>");
        return Command::SUCCESS;
    }
}