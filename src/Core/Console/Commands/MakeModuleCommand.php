<?php

namespace App\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeModuleCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('make:module')
            ->setDescription('Creates a new application module')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the module');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = ucfirst($input->getArgument('name'));
        $basePath = realpath(__DIR__ . '/../../../../src/Modules');

        if (!$basePath) {
            $basePath = realpath(__DIR__ . '/../../../../src');
            $basePath = $basePath . DIRECTORY_SEPARATOR . 'Modules';
            if (!is_dir($basePath)) {
                mkdir($basePath, 0755, true);
            }
        }

        $moduleDir = $basePath . DIRECTORY_SEPARATOR . $name;

        if (is_dir($moduleDir)) {
            $output->writeln("<error>Module {$name} already exists!</error>");
            return Command::FAILURE;
        }

        // Create directory structure
        $dirs = [
            '',
            '/Controllers',
            '/Models',
            '/Views',
            '/Services',
            '/Repositories'
        ];

        foreach ($dirs as $dir) {
            mkdir($moduleDir . $dir, 0755, true);
        }

        // Create Module class
        $moduleClassTemplate = "<?php

namespace App\Modules\\{$name};

use App\Core\Module\Module;
use App\Core\Container\Container;

class {$name}Module extends Module
{
    protected string \$name = '{$name}';

    public function boot(): void
    {
        \$container = Container::getInstance();
        
        // Register module specific services here
        // \$container->singleton({$name}Service::class);
    }
}
";
        file_put_contents($moduleDir . DIRECTORY_SEPARATOR . "{$name}Module.php", $moduleClassTemplate);

        // Create routes.php
        $routesTemplate = "<?php

use App\Core\Router\Router;
use App\Modules\\{$name}\Controllers\\{$name}Controller;

Router::get('/" . strtolower($name) . "', [{$name}Controller::class, 'index']);
";
        file_put_contents($moduleDir . DIRECTORY_SEPARATOR . 'routes.php', $routesTemplate);

        // Create Controller
        $controllerTemplate = "<?php

namespace App\Modules\\{$name}\Controllers;

class {$name}Controller
{
    public function index()
    {
        return \"Welcome to the {$name} module!\";
    }
}
";
        file_put_contents($moduleDir . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . "{$name}Controller.php", $controllerTemplate);

        $output->writeln("<info>Module {$name} created successfully!</info>");
        return Command::SUCCESS;
    }
}
