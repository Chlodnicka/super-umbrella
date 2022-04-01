<?php

declare(strict_types=1);

namespace SuperUmbrella\ProcessRunner;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class RunProcessesSequentiallyCommand extends Command
{
    protected static $defaultName = 'process-runner:sequence:run';

    public function __construct(private ProcessRunner $processRunner)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('initialProcessName', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('I run processes sequentially');

        $initialProcessName = $input->getArgument('initialProcessName');

        $this->processRunner->run("SuperUmbrella\\ProcessRunner\\SingleProcess\\$initialProcessName");

        $output->writeln('I am done');

        return Command::SUCCESS;
    }
}
