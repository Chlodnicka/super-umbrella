<?php

namespace SuperUmbrella\Tests\ProcessRunner;

use SuperUmbrella\ProcessRunner\ProcessRunner;
use PHPUnit\Framework\TestCase;

class ProcessRunnerTest extends TestCase
{
    public function testShouldRun(): void
    {
        // Given
        $processRunner = new ProcessRunner();

        // When
        $result = $processRunner->run('Test');

        // Then
        self::assertTrue($result);
    }
}
