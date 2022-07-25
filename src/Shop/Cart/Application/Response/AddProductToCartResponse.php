<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Application\Response;

final class AddProductToCartResponse
{
    public function __construct(private bool $isSuccess)
    {
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }
}