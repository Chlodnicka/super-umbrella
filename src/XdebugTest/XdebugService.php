<?php

declare(strict_types=1);

namespace SuperUmbrella\XdebugTest;

final class XdebugService
{
    public function run(string $param): bool
    {
        $a = 1;
        $b = 433;
        $c = 23;

        $result = $a + $b * $c;
        echo "$param $result";
        return true;
    }
}
