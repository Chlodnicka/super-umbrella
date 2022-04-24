<?php

namespace SuperUmbrella\Tests\XdebugTest;

use SuperUmbrella\XdebugTest\XdebugService;
use PHPUnit\Framework\TestCase;

/**
 * @covers \SuperUmbrella\XdebugTest\XdebugService
 */
class XdebugServiceTest extends TestCase
{
    public function testShouldRun(): void
    {
        // Given
        $xdebugService = new XdebugService();

        // When
        $result = $xdebugService->run('STH');

        // Then
        self::assertTrue($result);
    }
}
