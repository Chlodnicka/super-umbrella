<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain\Command;

final class AddProductToCartCommand
{
    public function __construct(
        public readonly int $productId,
        public readonly int $quantity,
        public readonly int $userId
    ) {
    }
}