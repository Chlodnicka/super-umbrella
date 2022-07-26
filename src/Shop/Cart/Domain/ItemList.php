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

    public function add(ProductDto $product, int $quantity, bool $userIsPremium): bool
    {
        if (isset($this->itemList[$product->getId()])) {
            $quantity = $this->itemList[$product->getId()] + $quantity;
        }

        if (AddToCartPolicy::canAddToCart($product, $quantity, $userIsPremium)) {
            $this->itemList[$product->getId()] = $quantity;
            return true;
        }

        return false;
    }

    public function updateQuantity(ProductDto $product, int $quantity, bool $userIsPremium): bool
    {
        if (isset($this->itemList[$product->getId()])) {
            return false;
        }

        if (AddToCartPolicy::canAddToCart($product, $quantity, $userIsPremium)) {
            $this->itemList[$product->getId()] = $quantity;
            return true;
        }
        return false;
    }

    public function remove(int $productId): bool
    {
        if (isset($this->itemList[$productId])) {
            unset($this->itemList[$productId]);
            return true;
        }
        return false;
    }

    public function get(): array
    {
        return $this->itemList;
    }
}