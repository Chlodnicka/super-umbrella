<?php

declare(strict_types=1);

namespace SuperUmbrella\Tests\Shop\Cart\MotherObjects;

use SuperUmbrella\Shop\Cart\Domain\Cart;

final class CartMotherObject
{
    public static function anEmptyCart(): Cart
    {
        return Cart::create(TestConstants::USER_ID);
    }
}