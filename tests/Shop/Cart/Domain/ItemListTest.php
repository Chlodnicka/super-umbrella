<?php

namespace SuperUmbrella\Tests\Shop\Cart\Domain;

use PHPUnit\Framework\TestCase;
use SuperUmbrella\Shop\Cart\Domain\ItemList;
use SuperUmbrella\Tests\Shop\Cart\MotherObjects\ProductDtoMotherObject;
use SuperUmbrella\Tests\Shop\Cart\MotherObjects\TestConstants;

/**
 * @covers \SuperUmbrella\Shop\Cart\Domain\ItemList
 */
class ItemListTest extends TestCase
{
    public function testShouldAddItemToItemList(): void
    {
        // Given
        $emptyItemList = new ItemList();

        // When
        $result = $emptyItemList->add(ProductDtoMotherObject::aStandardProduct(), 1, false);

        //Then
        self::assertTrue($result);
    }

    public function testShouldNotAddNotAvailableItemToItemList(): void
    {
        // Given
        $emptyItemList = new ItemList();

        // When
        $result = $emptyItemList->add(ProductDtoMotherObject::aNotAvailableAccessoryProduct(), 1, false);

        //Then
        self::assertFalse($result);
    }

    public function testShouldNotAddAnotherItemOfUniqueProductToItemList(): void
    {
        // Given
        $emptyItemList = new ItemList();
        $emptyItemList->add(ProductDtoMotherObject::anAvailableLimitedProductOnPresale(), 3, true);

        // When
        $result = $emptyItemList->add(ProductDtoMotherObject::anAvailableLimitedProductOnPresale(), 1, true);

        //Then
        self::assertFalse($result);
    }

    public function testShouldRemoveExistingItemFromItemList(): void
    {
        // Given
        $emptyItemList = new ItemList();
        $emptyItemList->add(ProductDtoMotherObject::anAvailableLimitedProductOnPresale(), 3, true);

        // When
        $result = $emptyItemList->remove(TestConstants::PRODUCT_ID);

        //Then
        self::assertTrue($result);
    }
}
