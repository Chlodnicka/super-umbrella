<?php

declare(strict_types=1);

namespace SuperUmbrella\ProcessRunner\SingleProcess;

use SuperUmbrella\ProcessRunner\SequenceOutput;
use SuperUmbrella\ProcessRunner\SingleProcess;

final class Single60SecondsProcess extends SingleProcess
{
    protected function runMain(): void
    {
        $logger = SequenceOutput::create();
        $logger->addLog('I run for 8 seconds');
        sleep(8);
        $logger->addLog('I run for 8 seconds - done');
    }

    protected function getNextProcessName(): ?string
    {
        return null;
    }
}
