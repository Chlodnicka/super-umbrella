<?php

namespace SuperUmbrella\Tests\Shop\Shared;

use PHPUnit\Framework\TestCase;
use SuperUmbrella\Shop\Shared\Exception\QuantityValueCannotBeLessThanZero;
use SuperUmbrella\Shop\Shared\Quantity;

/**
 * @covers \SuperUmbrella\Shop\Shared\Quantity
 */
class QuantityTest extends TestCase
{
    public function testShouldAdd(): void
    {
        // Given
        $initialQuantity = new Quantity(5);

        // When
        $resultQuantity = $initialQuantity->add(new Quantity(8));

        //Then
        self::assertTrue($resultQuantity->equals(new Quantity(13)));
    }

    public function testShouldSubtract(): void
    {
        // Given
        $initialQuantity = new Quantity(8);

        // When
        $resultQuantity = $initialQuantity->subtract(new Quantity(5));

        //Then
        self::assertTrue($resultQuantity->equals(new Quantity(3)));
    }

    public function testShouldNotSubtract(): void
    {
        // Expects
        $this->expectException(QuantityValueCannotBeLessThanZero::class);

        // Given
        $initialQuantity = new Quantity(5);

        // When
        $initialQuantity->subtract(new Quantity(8));
    }
}
