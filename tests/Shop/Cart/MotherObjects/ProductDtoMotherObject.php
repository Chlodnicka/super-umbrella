<?php

declare(strict_types=1);

namespace SuperUmbrella\Tests\Shop\Cart\MotherObjects;

use DateTime;
use DateTimeImmutable;
use SuperUmbrella\Shop\Cart\Domain\ProductDto;
use SuperUmbrella\Shop\Cart\Domain\ProductType;

final class ProductDtoMotherObject
{
    public static function aStandardProduct(int $id = TestConstants::PRODUCT_ID): ProductDto
    {
        return new ProductDto($id, ProductType::STANDARD, true, 0, null, null);
    }

    public static function anAvailableAccessoryProduct(int $id = TestConstants::PRODUCT_ID): ProductDto
    {
        return new ProductDto($id, ProductType::ACCESSORY, true, 0, null, null);
    }

    public static function aNotAvailableAccessoryProduct(int $id = TestConstants::PRODUCT_ID): ProductDto
    {
        return new ProductDto($id, ProductType::ACCESSORY, false, 0, null, null);
    }

    public static function aNotAvailableLimitedProduct(int $id = TestConstants::PRODUCT_ID): ProductDto
    {
        return new ProductDto($id, ProductType::LIMITED, false, 1000, null, null);
    }

    public static function anAvailableLimitedProductWithoutQuantity(int $id = TestConstants::PRODUCT_ID): ProductDto
    {
        return new ProductDto($id, ProductType::LIMITED, true, 0, null, null);
    }

    public static function anAvailableLimitedProductOnPresale(int $id = TestConstants::PRODUCT_ID): ProductDto
    {
        return new ProductDto($id, ProductType::LIMITED, true, 100,
            DateTimeImmutable::createFromMutable((new DateTime())->modify('-1 day')),
            DateTimeImmutable::createFromMutable((new DateTime())->modify('+1 day'))
        );
    }

    public static function anAvailableLimitedProductAfterPresale(int $id = TestConstants::PRODUCT_ID): ProductDto
    {
        return new ProductDto($id, ProductType::LIMITED, true, 100,
            DateTimeImmutable::createFromMutable((new DateTime())->modify('-5 day')),
            DateTimeImmutable::createFromMutable((new DateTime())->modify('-2 day')));
    }

    public static function anUniqueProduct(int $id = TestConstants::PRODUCT_ID): ProductDto
    {
        return new ProductDto($id, ProductType::UNIQUE, true, 0, null, null);
    }

}