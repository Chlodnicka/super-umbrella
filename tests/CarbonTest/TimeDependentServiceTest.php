<?php

namespace SuperUmbrella\Tests\CarbonTest;

use Carbon\Carbon;
use SuperUmbrella\CarbonTest\TimeDependentService;
use PHPUnit\Framework\TestCase;

class TimeDependentServiceTest extends TestCase
{
    public function testShouldMockDate(): void
    {
        // Given
        $timeDependentService = new TimeDependentService();
        Carbon::setTestNowAndTimezone(Carbon::create(2022, 03, 12, 12, 15, 00, new \DateTimeZone('Europe/Warsaw')));

        // When
        $carbonDate = $timeDependentService->blah();

        // Then
        self::assertSame('2022-03-12 12:09:00', $carbonDate->format('Y-m-d H:i:s'));
    }
}
