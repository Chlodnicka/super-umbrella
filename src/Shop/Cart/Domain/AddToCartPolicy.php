<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain;

use DateTimeImmutable;

final class AddToCartPolicy
{
    private const MAX_QUANTITY_OF_LIMITED_ON_PRESALE = 3;
    private const MAX_QUANTITY_OF_UNIQUE = 1;

    public static function canAddToCart(ProductDto $productDto, int $quantity, bool $userIsPremium): bool
    {
        if ($productDto->getType() === ProductType::STANDARD) {
            return true;
        }

        if ($productDto->isAvailable() && $productDto->getType() === ProductType::ACCESSORY) {
            return true;
        }

        if ($productDto->getType() === ProductType::LIMITED && $productDto->isAvailable() && $productDto->getQuantity() >= $quantity) {
            if (self::isOnPresale($productDto)) {
                return $userIsPremium && $quantity <= self::MAX_QUANTITY_OF_LIMITED_ON_PRESALE;
            }
            return true;
        }

        if($productDto->getType() === ProductType::UNIQUE) {
            return $quantity === self::MAX_QUANTITY_OF_UNIQUE;
        }

        return false;
    }


    private static function isOnPresale(ProductDto $productDto): bool
    {
        $now = new DateTimeImmutable();
        return $now >= $productDto->getPresaleStartedAt() && $now <= $productDto->getPresaleEndedAt();
    }
}