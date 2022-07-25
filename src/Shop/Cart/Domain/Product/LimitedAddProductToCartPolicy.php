<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain\Product;

use DateTimeImmutable;
use SuperUmbrella\Shop\Cart\Application\LoyaltyRepository;
use SuperUmbrella\Shop\Cart\Domain\AddProductToCartPolicy;
use SuperUmbrella\Shop\Cart\Domain\ProductDto;
use SuperUmbrella\Shop\Cart\Domain\ProductType;

final class LimitedAddProductToCartPolicy implements AddProductToCartPolicy
{
    public function __construct(private LoyaltyRepository $loyaltyRepository)
    {
    }

    public function supports(ProductType $type): bool
    {
        return $type === ProductType::LIMITED;
    }

    public function isAvailable(ProductDto $productDto, int $quantity): bool
    {
        if ($productDto->isAvailable() && $productDto->getQuantity() >= $quantity) {
            if ($this->isOnPresale($productDto)) {
                return $this->loyaltyRepository->isUserPremium($userId);
            }
            return true;
        }
        return false;
    }

    private function isOnPresale(ProductDto $productDto): bool
    {
        $now = new DateTimeImmutable();
        return $now >= $productDto->getPresaleStartedAt() && $now <= $productDto->getPresaleEndedAt();
    }
}