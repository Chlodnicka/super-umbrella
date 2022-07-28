<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain;

use SuperUmbrella\Shop\Shared\Quantity;

final class ItemList
{
    /** @var Item[] */
    private array $itemList;

    private function __construct(array $itemList)
    {
        $this->itemList = $itemList;
    }

    public static function create(): self
    {
        return new self([]);
    }

    public static function ofPayload(array $payload): self
    {
        $itemList = [];

        foreach ($payload as $itemPayload) {
            $item = Item::ofPayload($itemPayload);
            $itemList[$item->getProductId()] = $item;
        }

        return new self($itemList);
    }

    public function add(ProductDto $product, Quantity $quantity, bool $userIsPremium): bool
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