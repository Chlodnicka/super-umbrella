<?php

declare(strict_types=1);

namespace SuperUmbrella\ProcessRunner;

use Symfony\Component\Process\Process;

final class ProcessRunner
{
    public function run(string $initialProcessName): bool
    {
        $initialProcessCommand = ProcessCommandGenerator::generateSingleProcessCommand($initialProcessName);

        $initialProcess = Process::fromShellCommandline("nohup $initialProcessCommand &");
        $initialProcess->disableOutput();
        $initialProcess->run();

        return true;
    }
}
