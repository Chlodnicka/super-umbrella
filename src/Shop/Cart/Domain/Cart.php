<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain;

use SuperUmbrella\Shop\Cart\Domain\Command\AddProductToCartCommand;

final class Cart
{
    private function __construct(private ?int $id, private $userId, private ItemList $itemList)
    {
    }

    public static function create(int $userId): self
    {
        return new self(null, $userId, new ItemList());
    }

    public function add(ProductDto $product, int $quantity, bool $userIsPremium): bool
    {
        if (AddToCartPolicy::canAddToCart($product, $quantity, $userIsPremium)) {
            $this->itemList->add($product->getId(), $quantity);
            return true;
        }
        return false;
    }

    public function remove(int $productId): void
    {
        $this->itemList->remove($productId);
    }
}