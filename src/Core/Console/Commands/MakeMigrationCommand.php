<?php

namespace App\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Infrastructure\Migrations\Migration;

/**
 * Class MakeMigrationCommand
 * Handles the generation of migration files with a timestamped naming convention.
 */
class MakeMigrationCommand extends Command
{
    /**
     * Configures the command name, description, and required arguments.
     */
    protected function configure()
    {
        $this->setName('make:migration')
            ->setDescription('Create a new migration file')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the migration');
    }

    /**
     * Executes the logic to generate a migration boilerplate file.
     * * @param InputInterface $input
     * @param OutputInterface $output
     * @return int Command success status
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $timestamp = date('Y_m_d_His');
        $className = 'Migration_' . $timestamp . '_' . $name;
        $fileName = $timestamp . '_' . $name . '.php';

        // Path to the infrastructure layer where migrations are stored
        $path = __DIR__ . '/../../../Infrastructure/Migrations/' . $fileName;

        // Migration file boilerplate using the Schema and Blueprint system
        $template = "<?php

        use App\Core\Database\Schema\Schema;
        use App\Core\Database\Schema\Blueprint;
        use App\Infrastructure\Migrations\Migration;
        
        class Migration_{$timestamp}_{$name} extends Migration
        {
            /**
             * Run the migrations (Create Table).
             */
            public function up(): void
            {
                Schema::create('{$name}', function (Blueprint \$table) {
                    \$table->id();
                    \$table->string('name');
                    \$table->timestamps();
                });
            }

            /**
             * Reverse the migrations (Drop Table).
             */
            public function down(): void
            {
                // SQL DROP logic
            }
        }";

        // Write the template to the file system
        file_put_contents($path, $template);

        $output->writeln("<info>Migration created: {$fileName}</info>");
        return Command::SUCCESS;
    }
}