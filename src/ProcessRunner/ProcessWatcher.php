<?php

declare(strict_types=1);

namespace SuperUmbrella\ProcessRunner;

use Symfony\Component\Process\Process;

final class ProcessWatcher
{
    public function run(): void
    {
        //in *loop*:
        //check if processes are running
        //if yes -> check if they did not exceeded max time for execution or exceeded max available memory
        ////if yes -> terminate them and notify about failure of mother process and break the *loop*
        ////if not -> current print logs and sleep for 10/30s
        //if not -> notify about end of all processes and break the *loop*
    }
}
