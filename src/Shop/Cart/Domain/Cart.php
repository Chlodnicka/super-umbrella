<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain;

use DateTimeImmutable;
use SuperUmbrella\Shop\Shared\DateTimeHelper;

final class Cart
{
    private ?DateTimeImmutable $boughtAt = null;

    private function __construct(private ?int $id, private $userId, private readonly ItemList $itemList)
    {
    }

    public static function create(int $userId): self
    {
        return new self(null, $userId, new ItemList());
    }

    public function add(ProductDto $product, int $quantity, bool $userIsPremium): bool
    {
        if ($this->boughtAt) {
            return false;
        }
        return $this->itemList->add($product, $quantity, $userIsPremium);
    }

    public function updateQuantity(ProductDto $product, int $quantity, bool $userIsPremium): bool
    {
        if ($this->boughtAt) {
            return false;
        }
        return $this->itemList->updateQuantity($product, $quantity, $userIsPremium);
    }

    public function remove(int $productId): bool
    {
        if ($this->boughtAt) {
            return false;
        }
        $this->itemList->remove($productId);
        return true;
    }

    public function buy(): bool
    {
        $this->boughtAt = DateTimeHelper::now();
        return true;
    }
}