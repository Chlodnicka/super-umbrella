<?php

namespace SuperUmbrella\Shop\Cart\Application;

use SuperUmbrella\Shop\Cart\Domain\Cart;

interface CartRepository
{
    public function get(int $userId): Cart;

    public function save(Cart $cart): void;
}