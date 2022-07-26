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

    public function add(int $productId, int $quantity): void
    {
        $this->itemList[$productId] = $quantity;
    }

    public function get(): array
    {
        return $this->itemList;
    }
}