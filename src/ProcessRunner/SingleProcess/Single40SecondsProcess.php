<?php

declare(strict_types=1);

namespace SuperUmbrella\ProcessRunner\SingleProcess;

use SuperUmbrella\ProcessRunner\SequenceOutput;
use SuperUmbrella\ProcessRunner\SingleProcess;

final class Single40SecondsProcess extends SingleProcess
{
    protected function runMain(): void
    {
        $logger = SequenceOutput::create();
        $logger->addLog('I run for 7 seconds');
        sleep(7);
        $logger->addLog('I run for 7 seconds - done');
    }

    protected function getNextProcessName(): ?string
    {
        return SingleThrowingErrorProcess::class;
    }
}
