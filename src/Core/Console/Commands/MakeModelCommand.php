<?php

namespace App\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeModelCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('make:model')
            ->setDescription('Creates a new Model class in Domain')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the Model');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $className = $input->getArgument('name');
        
        $path = __DIR__ . '/../../../Domain/Models/' . $className . '.php'; 

        if (file_exists($path)) {
            $output->writeln("<error>Model {$className} already exists!</error>");
            return Command::FAILURE;
        }

        $template = "<?php
        \n\nnamespace App\Domain\Models;
        \n\nuse App\Domain\Models\Model;
        \n\nclass {$className} extends Model\n
        {\n    protected \$table = '" . strtolower($className) . "s';\n\n    public function __construct()\n    {\n        parent::__construct();\n    }\n}";

        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        file_put_contents($path, $template);

        $output->writeln("<info>Model {$className} created successfully!</info>");
        return Command::SUCCESS;
    }
}