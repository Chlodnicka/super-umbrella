<?php

namespace SuperUmbrella\Tests\Shop\Cart\Domain;

use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;
use SuperUmbrella\Shop\Cart\Domain\AddToCartPolicy;
use SuperUmbrella\Shop\Cart\Domain\AddToCartPolicyHandler2;
use SuperUmbrella\Shop\Cart\Domain\ProductDto;
use SuperUmbrella\Tests\Shop\Cart\MotherObjects\ProductDtoMotherObject;

class AddToCartPolicyTest extends TestCase
{
    /**
     * @param ProductDto $productDto
     * @param int $quantity
     * @param bool $userIsPremium
     * @param bool $expected
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
        $result = AddToCartPolicy::canAddToCart($productDto, $quantity, $userIsPremium);

        //Then
        self::assertSame($expected, $result);
    }

    /**
     * @param ProductDto $productDto
     * @param int $quantity
     * @param bool $userIsPremium
     * @param bool $expected
     * @return void
     * @dataProvider getTestCases
     */
    public function testIfShouldAddToCart2(
        ProductDto $productDto,
        int $quantity,
        bool $userIsPremium,
        bool $expected
    ): void {
        // Given
        $addToCartPolicy = new AddToCartPolicyHandler2($quantity, $userIsPremium);

        // When
        $result = $addToCartPolicy->isAvailable($productDto);

        //Then
        self::assertSame($expected, $result);
    }

    #[ArrayShape([
        'standard' => "array",
        'accessoryAvailable' => "array",
        'accessoryNotAvailable' => "array",
        'limitedNotAvailable' => "array",
        'limitedAvailableWithoutQuantity' => "array",
        'limitedAvailableOnPresaleNotPremiumUser' => "array",
        'limitedAvailableOnPresalePremiumUser' => "array",
        'limitedAvailableAfterPresale' => "array"
    ])] public function getTestCases(): array
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
            ]
        ];
    }
}
