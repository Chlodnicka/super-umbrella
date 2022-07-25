<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Application;


use SuperUmbrella\Shop\Cart\Application\Response\AddProductToCartResponse;
use SuperUmbrella\Shop\Cart\Domain\AddToCartPolicyHandler2;
use SuperUmbrella\Shop\Cart\Domain\Cart;

final class CartService
{

    public function __construct(
        private CartRepository $cartRepository,
        private AddToCartPolicyHandler2 $addToCartPolicyHandler2
    ) {
    }

    public function addProduct(int $userId, int $productId, int $quantity = 1): AddProductToCartResponse
    {
        $cart = $this->cartRepository->get($userId);
        $isUserPremium = $this->loyaltyRepository->isUserPremium($userId);
        $isSuccess = $cart->addProduct($product, $quantity, $isUserPremium);
        $this->cartRepository->save($cart);
        return new AddProductToCartResponse($isSuccess);
    }

    public function get(int $userId): Cart
    {
        return $this->cartRepository->get($userId);
    }

    public function removeProduct(int $userId, int $productId): void
    {
        $cart = $this->cartRepository->get($userId);
        $cart->removeProduct($productId);
    }

    public function buy(int $userId): void
    {
        $cart = $this->cartRepository->get($userId);
        $cart->buy();
    }

}