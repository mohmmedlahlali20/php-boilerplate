<?php

namespace App\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeModelCommand extends Command
{
    protected static $defaultName = 'make:model';

    protected function configure()
    {
        $this->setDescription('Creates a new Model class in Domain')
             ->addArgument('name', InputArgument::REQUIRED, 'The name of the Model');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        // Ghadi i-t-7et f Domain/Models bhal l-arborescence li 3ndek
        $path = __DIR__ . '/../../../Domain/Models/' . $name . '.php'; 

        if (file_exists($path)) {
            $output->writeln("<error>Model {$name} already exists!</error>");
            return Command::FAILURE;
        }

        $template = "<?php\n\nnamespace App\Domain\Models;\n\nuse App\Infrastructure\Database;\n\nclass {$name}\n{\n    protected \$table = '" . strtolower($name) . "s';\n\n    public function __construct()\n    {\n        // logic...\n    }\n}";

        file_put_contents($path, $template);

        $output->writeln("<info>Model {$name} created in Domain/Models!</info>");
        return Command::SUCCESS;
    }
}