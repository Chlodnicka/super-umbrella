<?php

declare(strict_types=1);

namespace SuperUmbrella\CarbonTest;

use Carbon\Carbon;

final class TimeDependentService
{
    public function blah(): Carbon
    {
        $a = Carbon::now(new \DateTimeZone('Europe/Warsaw'));
        $a->day;
        $a->year;
        $a->isWeekday();
        $a->isWeekend();
        $a->subMinutes(6);
        return $a;
    }

}
