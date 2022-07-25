<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain;

use SuperUmbrella\Shop\Cart\Domain\Command\AddProductToCartCommand;

interface AddProductToCartPolicy
{
    public function supports(ProductType $type): bool;

    public function isAvailable(AddProductToCartCommand $addProductToCart): bool;
}