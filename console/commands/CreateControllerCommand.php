<?php
namespace Console\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'create:controller')]
class CreateControllerCommand extends Command
{
  protected static $defaultName = 'create:controller';
  protected static $defaultDescription = 'Creates a new controller';

  protected function configure()
  {
    $this->addArgument('controller', InputArgument::REQUIRED, 'Controller name');
  }

  protected function execute(InputInterface $input, OutputInterface $output): int
  {
    $controllerName = $input->getArgument('controller');
    $controller = 'app\\controllers\\' . $controllerName . '.php';
    if(file_exists($controller))
    {
      $output->writeln('ERROR MESSAGE: Controller already exists');
      return Command::FAILURE;
    }

    if(!$file = fopen($controller, 'w'))
    {
      $output->writeln('ERROR MESSAGE: Can\'t create controller');
      fclose($file);
      return Command::FAILURE;
    }

    // controller Code
    $namespace = "namespace App\Controllers;\n\n";
    $useModel = "use Core\Model;\n";
    $useRequest = "use Core\Request;\n\n";
    $classCode = "class " . $controllerName . "\n{\n\n}";

    if(!fwrite($file, "<?php\n" . $namespace . $useModel . $useRequest . $classCode))
    {
      $output->writeln('ERROR MESSAGE: Can\'t create controller');
      fclose($file);
      return Command::FAILURE;
    }
    fclose($file);
    $output->writeln('SUCCES MESSAGE: ' . $controllerName . ' has been created');
    return Command::SUCCESS;
  }
}
