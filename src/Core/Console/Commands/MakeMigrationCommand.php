<?php

namespace App\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Infrastructure\Migrations\Migration;

class MakeMigrationCommand extends Command
{
    protected function configure()
    {
        $this->setName('make:migration')
            ->setDescription('Create a new migration file')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the migration');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $timestamp = date('Y_m_d_His');
        $className = 'Migration_' . $timestamp . '_' . $name;
        $fileName = $timestamp . '_' . $name . '.php';

        $path = __DIR__ . '/../../../Infrastructure/Migrations/' . $fileName;

        $template = "<?php

        use App\Core\Database\Schema\Schema;
        use App\Core\Database\Schema\Blueprint;
        use App\Infrastructure\Migrations\Migration;
        
        class Migration_{$timestamp}_{$name} extends Migration
        {
            public function up(): void
            {
                Schema::create('{$name}', function (Blueprint \$table) {
                    \$table->id();
                    \$table->string('name');
                    \$table->timestamps();
                });
            }

            public function down(): void
            {
                // SQL DROP logic
            }
        }";
        file_put_contents($path, $template);
        $output->writeln("<info>Migration created: {$fileName}</info>");
        return Command::SUCCESS;
    }
}
