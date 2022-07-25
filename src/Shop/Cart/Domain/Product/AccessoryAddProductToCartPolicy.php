<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain\Product;

use SuperUmbrella\Shop\Cart\Domain\AddProductToCartPolicy;
use SuperUmbrella\Shop\Cart\Domain\ProductDto;
use SuperUmbrella\Shop\Cart\Domain\ProductType;

final class AccessoryAddProductToCartPolicy implements AddProductToCartPolicy
{
    public function supports(ProductType $type): bool
    {
        return $type === ProductType::ACCESSORY;
    }

    public function isAvailable(ProductDto $productDto, int $quantity): bool
    {
        return (bool)$productDto->isAvailable();
    }
}