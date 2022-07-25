<?php

namespace SuperUmbrella\Tests\Shop\Cart\Application;

use PHPUnit\Framework\TestCase;
use SuperUmbrella\Shop\Cart\Application\CartRepository;
use SuperUmbrella\Shop\Cart\Application\CartService;
use SuperUmbrella\Shop\Cart\Application\LoyaltyRepository;
use SuperUmbrella\Shop\Cart\Application\ProductRepository;
use SuperUmbrella\Tests\Shop\Cart\MotherObjects\CartMotherObject;
use SuperUmbrella\Tests\Shop\Cart\MotherObjects\ProductDtoMotherObject;
use SuperUmbrella\Tests\Shop\Cart\MotherObjects\TestConstants;

class CartServiceTest extends TestCase
{

    public function testShouldAddProductToCart(): void
    {
        // Given
        $cartRepository = $this->createMock(CartRepository::class);
        $cartRepository->method('get')->willReturn(CartMotherObject::anEmptyCart());
        $productRepository = $this->createMock(ProductRepository::class);
        $productRepository->method('get')->willReturn(ProductDtoMotherObject::aStandardProduct());
        $loyaltyRepository = $this->createMock(LoyaltyRepository::class);
        $loyaltyRepository->method('isUserPremium')->willReturn(false);
        $cartService = new CartService($cartRepository, $productRepository, $loyaltyRepository);

        // When
        $response = $cartService->addProduct(TestConstants::USER_ID, TestConstants::PRODUCT_ID);

        //Then
        self::assertTrue($response->isSuccess());
    }

    public function testShouldNotAddProductToCart(): void
    {
        // Given
        $cartRepository = $this->createMock(CartRepository::class);
        $cartRepository->method('get')->willReturn(CartMotherObject::anEmptyCart());
        $productRepository = $this->createMock(ProductRepository::class);
        $productRepository->method('get')->willReturn(ProductDtoMotherObject::aNotAvailableAccessoryProduct());
        $loyaltyRepository = $this->createMock(LoyaltyRepository::class);
        $loyaltyRepository->method('isUserPremium')->willReturn(false);
        $cartService = new CartService($cartRepository, $productRepository, $loyaltyRepository);

        // When
        $response = $cartService->addProduct(TestConstants::USER_ID, TestConstants::PRODUCT_ID);

        //Then
        self::assertFalse($response->isSuccess());
    }
}
