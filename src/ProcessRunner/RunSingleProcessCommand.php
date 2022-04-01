<?php

declare(strict_types=1);

namespace SuperUmbrella\ProcessRunner;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class RunSingleProcessCommand extends Command
{
    public const COMMAND = 'process-runner:single:run';
    protected static $defaultName = self::COMMAND;

    public function __construct(private ProcessRunner $processRunner)
    {
        parent::__construct();
    }


    protected function configure(): void
    {
        $this->addArgument('processName', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $processName = $input->getArgument('processName');
        $process = $this->createSingleProcess($processName);
        $process->run();
        return Command::SUCCESS;
    }

    private function createSingleProcess(string $processName): SingleProcess
    {
        $reflection = new \ReflectionClass($processName);
        $instance = $reflection->newInstanceArgs([$this->processRunner]);

        if ($instance instanceof SingleProcess) {
            return $instance;
        }
        throw new \RuntimeException("Class of name $processName is not an instance of SingleProcess");
    }

}
