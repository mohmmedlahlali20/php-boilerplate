<?php

namespace App\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeRepositoryCommand extends Command
{
    protected function configure()
    {
        $this->setName('make:repository')
            ->setDescription('Create a new repository extending BaseRepository')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the entity (e.g., User)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $className = $name . 'Repository';
        $path = __DIR__ . '/../../../Application/Repositories/' . $className . '.php';

        if (file_exists($path)) {
            $output->writeln("<error>Repository {$className} already exists!</error>");
            return Command::FAILURE;
        }

        $template = "<?php

namespace App\Application\Repositories;

/**
 * Class {$className}
 * Automatically handles CRUD for the {$name} model via BaseRepository.
 */
class {$className} extends BaseRepository
{
    /**
     * Custom repository methods for {$name} can be added here.
     */
}
";

        if (!is_dir(dirname($path))) mkdir(dirname($path), 0755, true);
        file_put_contents($path, $template);

        $output->writeln("<info>Repository {$className} created successfully! 🚀</info>");
        return Command::SUCCESS;
    }
}