<?php

namespace SuperUmbrella\Tests\Shop\Cart\Domain;

use PHPUnit\Framework\TestCase;
use SuperUmbrella\Shop\Cart\Domain\AddToCartPolicy;
use SuperUmbrella\Shop\Cart\Domain\ProductDto;
use SuperUmbrella\Shop\Shared\Exception\QuantityValueCannotBeLessThanZero;
use SuperUmbrella\Shop\Shared\Quantity;
use SuperUmbrella\Tests\Shop\Cart\MotherObjects\ProductDtoMotherObject;

/**
 * @covers \SuperUmbrella\Shop\Cart\Domain\AddToCartPolicy
 */
class AddToCartPolicyTest extends TestCase
{
    /**
     * @param ProductDto $productDto
     * @param int $quantity
     * @param bool $userIsPremium
     * @param bool $expected
     * @throws QuantityValueCannotBeLessThanZero
     * @return void
     * @dataProvider getTestCases
     */
    public function testIfShouldAddToCart(
        ProductDto $productDto,
        int $quantity,
        bool $userIsPremium,
        bool $expected
    ): void {
        // When
        $result = AddToCartPolicy::canAddToCart($productDto, new Quantity($quantity), $userIsPremium);

        //Then
        self::assertSame($expected, $result);
    }

    public function getTestCases(): array
    {
        return [
            'standard' => [
                'product' => ProductDtoMotherObject::aStandardProduct(),
                'quantity' => 1,
                'userIsPremium' => false,
                'expected' => true
            ],
            'accessoryAvailable' => [
                'product' => ProductDtoMotherObject::anAvailableAccessoryProduct(),
                'quantity' => 1,
                'userIsPremium' => false,
                'expected' => true
            ],
            'accessoryNotAvailable' => [
                'product' => ProductDtoMotherObject::aNotAvailableAccessoryProduct(),
                'quantity' => 1,
                'userIsPremium' => false,
                'expected' => false
            ],
            'limitedNotAvailable' => [
                'product' => ProductDtoMotherObject::aNotAvailableLimitedProduct(),
                'quantity' => 1,
                'userIsPremium' => false,
                'expected' => false
            ],
            'limitedAvailableWithoutQuantity' => [
                'product' => ProductDtoMotherObject::anAvailableLimitedProductWithoutQuantity(),
                'quantity' => 1,
                'userIsPremium' => false,
                'expected' => false
            ],
            'limitedAvailableOnPresaleNotPremiumUser' => [
                'product' => ProductDtoMotherObject::anAvailableLimitedProductOnPresale(),
                'quantity' => 1,
                'userIsPremium' => false,
                'expected' => false
            ],
            'limitedAvailableOnPresalePremiumUser' => [
                'product' => ProductDtoMotherObject::anAvailableLimitedProductOnPresale(),
                'quantity' => 1,
                'userIsPremium' => true,
                'expected' => true
            ],
            'limitedAvailableAfterPresale' => [
                'product' => ProductDtoMotherObject::anAvailableLimitedProductAfterPresale(),
                'quantity' => 1,
                'userIsPremium' => false,
                'expected' => true
            ],
            'limitedAvailableOnPresalePremiumUserMaxQuantity' => [
                'product' => ProductDtoMotherObject::anAvailableLimitedProductOnPresale(),
                'quantity' => 3,
                'userIsPremium' => true,
                'expected' => true
            ],
            'limitedAvailableOnPresalePremiumUserMoreThanMaxQuantity' => [
                'product' => ProductDtoMotherObject::anAvailableLimitedProductOnPresale(),
                'quantity' => 4,
                'userIsPremium' => true,
                'expected' => false
            ],
            'unique' => [
                'product' => ProductDtoMotherObject::anUniqueProduct(),
                'quantity' => 1,
                'userIsPremium' => false,
                'expected' => true
            ],
            'uniqueMoreThan1Quantity' => [
                'product' => ProductDtoMotherObject::anUniqueProduct(),
                'quantity' => 2,
                'userIsPremium' => false,
                'expected' => false
            ]
        ];
    }

}
