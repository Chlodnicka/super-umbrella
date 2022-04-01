<?php

declare(strict_types=1);

namespace SuperUmbrella\ProcessRunner\SingleProcess;

use SuperUmbrella\ProcessRunner\SequenceOutput;
use SuperUmbrella\ProcessRunner\SingleProcess;

final class Single20SecondsProcess extends SingleProcess
{
    protected function runMain(): void
    {
        $logger = SequenceOutput::create();
        $logger->addLog('I run for 5 seconds');
        sleep(5);
        $logger->addLog('I run for 5 seconds - done');
    }

    protected function getNextProcessName(): ?string
    {
        return Single40SecondsProcess::class;
    }
}
