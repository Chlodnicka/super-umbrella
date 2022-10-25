<?php

declare(strict_types=1);


namespace SuperUmbrella\Tests\DsTest;

use PHPUnit\Framework\TestCase;
use SuperUmbrella\DsTest\DsService;

class ServiceTest extends TestCase
{
    /**
     * @test
     */
    public function shouldTest(): void
    {
        // Expects

        // Given
        $dsService = new DsService();

        // When
        $dsService->createVector();

        //Then

    }
}
