<?php

namespace SuperUmbrella\Shop\Cart\Application;

use SuperUmbrella\Shop\Cart\Domain\ProductDto;

interface ProductRepository
{
    public function get(int $productId): ProductDto;
}