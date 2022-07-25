<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain;

final class Cart
{
    private function __construct(private ?int $id, private $userId, private ItemList $itemList)
    {
    }

    public static function create(int $userId): self
    {
        return new self(null, $userId, new ItemList());
    }

    public function addProduct(AddProductToCartPolicy $product, int $quantity, bool $userIsPremium): bool
    {
        if (AddToCartPolicy::canAddToCart($product, $quantity, $userIsPremium)) {
            $this->itemList->add($product, $quantity);
            return true;
        }
        return false;
    }

    public function remove(int $productId): void
    {
        $this->itemList->remove($productId);
    }
}