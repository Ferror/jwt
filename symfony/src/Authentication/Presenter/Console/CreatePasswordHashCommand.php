<?php
declare(strict_types=1);

namespace Ferror\Authentication\Presenter\Console;

use Ferror\Authentication\Application\PasswordEncoder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreatePasswordHashCommand extends Command
{
    private $encoder;

    public function __construct(PasswordEncoder $encoder)
    {
        $this->encoder = $encoder;
        parent::__construct('password:create:hash');
    }

    protected function configure(): void
    {
        $this->addArgument('password', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln($this->encoder->encode($input->getArgument('password')));

        return Command::SUCCESS;
    }
}
