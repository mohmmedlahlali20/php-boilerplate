<?php

namespace App\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeControllerCommand extends Command
{
    protected static $defaultName = 'make:controller';

    protected function configure()
    {
        $this->setDescription('Creates a new controller class')
             ->addArgument('name', InputArgument::REQUIRED, 'The name of the controller');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $path = __DIR__ . '/../../Application/Controllers/' . $name . '.php';

        if (file_exists($path)) {
            $output->writeln("<error>Controller {$name} already exists!</error>");
            return Command::FAILURE;
        }

        $template = "<?php\n\nnamespace App\Application\Controllers;\n\nclass {$name} \n{\n    public function index()\n    {\n        // code...\n    }\n}";

        file_put_contents($path, $template);

        $output->writeln("<info>Controller {$name} created successfully!</info>");
        return Command::SUCCESS;
    }
}