<?php

declare(strict_types=1);

namespace SuperUmbrella\ProcessRunner;

final class ProcessCommandGenerator
{
    public static function generateSingleProcessCommand(string $processName): string
    {
        $runSingleProcessCommand = RunSingleProcessCommand::COMMAND;
        return "php bin/console $runSingleProcessCommand '$processName'";
    }
}
