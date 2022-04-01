<?php

declare(strict_types=1);

namespace SuperUmbrella\ProcessRunner;

abstract class SingleProcess
{
    public function __construct(private ProcessRunner $processRunner)
    {
    }

    public function run(): void
    {
        $this->runMain();
        if ($this->getNextProcessName()) {
            $this->processRunner->run($this->getNextProcessName());
        }
    }

    abstract protected function runMain(): void;

    abstract protected function getNextProcessName(): ?string;
}
