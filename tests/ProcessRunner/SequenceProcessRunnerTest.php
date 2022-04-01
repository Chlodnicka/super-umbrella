<?php

namespace SuperUmbrella\ProcessRunner;

use PHPUnit\Framework\TestCase;

/**
 * @covers \SuperUmbrella\ProcessRunner\SequenceProcessRunner
 */
class SequenceProcessRunnerTest extends TestCase
{
    public function testShouldRunProcess(): void
    {
        // Given
        $processRunner = new SequenceProcessRunner();

        // When
        $result = $processRunner->run();

        // Then
        self::assertTrue($result);
    }
}
