<?php

namespace App\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class MakeControllerCommand
 * * Handles the automated creation of Controller classes via the CLI.
 */
class MakeControllerCommand extends Command
{
    /**
     * Configures the current command settings.
     */
    protected function configure()
    {
        $this
            ->setName('make:controller')
            ->setDescription('Creates a new controller class')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the controller');
    }

    /**
     * Executes the controller generation logic.
     * * @param InputInterface $input
     * @param OutputInterface $output
     * @return int Failure or Success code
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inputName = $input->getArgument('name');

        // Force "Controller" suffix if not provided by the user
        $className = str_ends_with($inputName, 'Controller') ? $inputName : $inputName . 'Controller';

        // Define the destination path within the Application layer
        $path = __DIR__ . '/../../../Application/Controllers/' . $className . '.php';

        // Check if the file already exists to prevent overwriting
        if (file_exists($path)) {
            $output->writeln("<error>Controller {$className} already exists!</error>");
            return Command::FAILURE;
        }

        // The boilerplate code for the new controller
        $template = "<?php
          \n\nnamespace App\Application\Controllers;
          \n\nuse App\Application\Controllers\Controller;
          \n\nclass {$className} extends Controller\n{
          \n    public function index()\n    {\n        // code...\n    }\n}";

        // Ensure the directory exists before saving the file
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        // Save the generated controller class
        file_put_contents($path, $template);

        $output->writeln("<info>Controller {$className} created successfully!</info>");
        return Command::SUCCESS;
    }
}