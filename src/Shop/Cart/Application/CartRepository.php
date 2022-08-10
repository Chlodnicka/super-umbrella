<?php

namespace SuperUmbrella\Shop\Cart\Application;

use SuperUmbrella\Shop\Cart\Domain\Cart;
use SuperUmbrella\Shop\Shared\UserId;

interface CartRepository
{
    public function get(UserId $userId): Cart;

    public function save(Cart $cart): void;
}