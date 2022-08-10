<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Application;


use SuperUmbrella\Shop\Cart\Application\Response\AddProductToCartResponse;
use SuperUmbrella\Shop\Cart\Domain\Cart;
use SuperUmbrella\Shop\Shared\Quantity;
use SuperUmbrella\Shop\Shared\UserId;

final class CartService
{

    public function __construct(
        private readonly CartRepository $cartRepository,
        private readonly ProductRepository $productRepository,
        private readonly LoyaltyRepository $loyaltyRepository
    ) {
    }

    public function addProduct(UserId $userId, int $productId, int $quantity = 1): AddProductToCartResponse
    {
        $productDto = $this->productRepository->get($productId);
        $cart = $this->cartRepository->get($userId);
        $isUserPremium = $this->loyaltyRepository->isUserPremium($userId);

        $isSuccess = $cart->add($productDto, new Quantity($quantity), $isUserPremium);

        if ($isSuccess) {
            $this->cartRepository->save($cart);
        }

        return new AddProductToCartResponse($isSuccess);
    }

    public function get(UserId $userId): Cart
    {
        return $this->cartRepository->get($userId);
    }

    public function removeProduct(UserId $userId, int $productId): void
    {
        $cart = $this->cartRepository->get($userId);
        $cart->remove($productId);
    }

    public function buy(UserId $userId): void
    {
        $cart = $this->cartRepository->get($userId);
        $cart->buy();
    }
}