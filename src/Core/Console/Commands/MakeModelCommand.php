<?php

namespace App\Core\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class MakeModelCommand
 * Generates a feature-rich Model boilerplate with fillables and validation rules.
 */
class MakeModelCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('make:model')
            ->setDescription('Creates a new rich Model class in Domain')
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

        // We use HEREDOC (<<<EOT) to keep the template clean and readable
        $template = "<?php

namespace App\Domain\Models;

use App\Domain\Models\Model;

/**
 * Class {$className}
 * Domain model representing the " . strtolower($className) . "s entity.
 */
class {$className} extends Model
{
    protected \$table = '" . strtolower($className) . "s';

    public \$id;


    /**
     * Attributes that are mass-assignable.
     * @var array
     */
    public \$fillable = [];

    /**
     * Validation rules for the {$className} model.
     * @return array
     */
    public function rules(): array
    {
        return [

        ];
    }

    /**
     * Example of a domain-specific helper method.
     */
    public function getShortName()
    {
        return explode(' ', \$this->name)[0];
    }

    public function __construct()
    {
        parent::__construct();
    }
}";

        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        file_put_contents($path, $template);

        $output->writeln("<info>Model {$className} created with rich structure! 🚀</info>");
        return Command::SUCCESS;
    }
}