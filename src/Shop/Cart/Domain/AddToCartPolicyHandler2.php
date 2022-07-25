<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain;

use SuperUmbrella\Shop\Cart\Application\ProductRepository;

final class AddToCartPolicyHandler2
{

    /**
     * @param AddProductToCartPolicy[] $productPolicies
     * @param ProductRepository $productRepository
     */
    public function __construct(
        private readonly array $productPolicies,
        private readonly ProductRepository $productRepository
    ) {
    }

    public function isAvailable(int $productId, int $quantity): bool
    {
        $productDto = $this->productRepository->get($productId);
        foreach ($this->productPolicies as $product) {
            if ($product->supports($productDto->getType())) {
                return $product->isAvailable($productDto, $quantity);
            }
        }
        return false;
    }

}