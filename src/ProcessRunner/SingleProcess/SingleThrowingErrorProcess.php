<?php

declare(strict_types=1);

namespace SuperUmbrella\ProcessRunner\SingleProcess;

use SuperUmbrella\ProcessRunner\SequenceOutput;
use SuperUmbrella\ProcessRunner\SingleProcess;

final class SingleThrowingErrorProcess extends SingleProcess
{
    protected function runMain(): void
    {
        $logger = SequenceOutput::create();
        $logger->addLog('I throw error after 10 seconds');
        sleep(10);
        throw new \Exception('Haha!');
    }

    protected function getNextProcessName(): ?string
    {
        return Single60SecondsProcess::class;
    }
}
