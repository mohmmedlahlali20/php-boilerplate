<?php

namespace App\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeControllerCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('make:controller')
            ->setDescription('Creates a new controller class')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the controller');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inputName = $input->getArgument('name');

        $className = str_ends_with($inputName, 'Controller') ? $inputName : $inputName . 'Controller';

        $path = __DIR__ . '/../../../Application/Controllers/' . $className . '.php';

        if (file_exists($path)) {
            $output->writeln("<error>Controller {$className} already exists!</error>");
            return Command::FAILURE;
        }

        $template = "<?php
          \n\nnamespace App\Application\Controllers;
          \n\nuse App\Application\Controllers\Controller;
          \n\nclass {$className} extends Controller\n{
          \n    public function index()\n    {\n        // code...\n    }\n}";

        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        file_put_contents($path, $template);

        $output->writeln("<info>Controller {$className} created successfully!</info>");
        return Command::SUCCESS;
    }
}
