<?php

namespace App\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeServiceCommand extends Command
{
    protected function configure()
    {
        $this->setName('make:service')
            ->setDescription('Create a new service class extending Base Service')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the service (e.g., Auth)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $className = $name . 'Service';
        $path = __DIR__ . '/../../../Application/Services/' . $className . '.php';

        if (file_exists($path)) {
            $output->writeln("<error>Service {$className} already exists!</error>");
            return Command::FAILURE;
        }

        $template = "<?php

namespace App\Application\Services;

/**
 * Class {$className}
 * Handles business logic for {$name} operations.
 */
class {$className} extends Service
{
    public function __construct()
    {
        // Inject repositories here
    }

    public function handle(array \$data = [])
    {
        // Example usage of your Base Service helpers
        if (!\$this->validate(\$data, ['email' => 'required'])) {
            return \$this->formatResponse(false, null, 'Validation failed');
        }

        try {
            // Logic here...
            \$this->log('{$name} action executed successfully');
            return \$this->formatResponse(true, \$data, 'Success');
        } catch (\Exception \$e) {
            \$this->log(\$e->getMessage(), 'error');
            return \$this->formatResponse(false, null, \$e->getMessage());
        }
    }
}
";

        if (!is_dir(dirname($path))) mkdir(dirname($path), 0755, true);
        file_put_contents($path, $template);

        $output->writeln("<info>Service {$className} created successfully! 🚀</info>");
        return Command::SUCCESS;
    }
}