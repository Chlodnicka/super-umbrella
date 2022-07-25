<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain;

final class ItemList
{
    private array $itemList;

    public function __construct()
    {
        $this->itemList = [];
    }

    public function add(AddProductToCartPolicy $product, int $quantity): void
    {
        $this->itemList[$product->getId()] = $quantity;
    }

    public function get(): array
    {
        return $this->itemList;
    }
}