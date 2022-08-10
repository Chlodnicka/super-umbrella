<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain;

use SuperUmbrella\Shop\Shared\Quantity;
use Webmozart\Assert\Assert;

final class Item
{
    private const PRODUCT_ID = 'product_id';
    private const QUANTITY = 'quantity';

    private int $productId;
    private Quantity $quantity;

    public function __construct(int $productId, Quantity $quantity)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public static function ofPayload(array $payload): self
    {
        Assert::inArray(self::PRODUCT_ID, $payload);
        Assert::integerish($payload[self::PRODUCT_ID]);
        Assert::inArray(self::QUANTITY, $payload);
        Assert::integerish($payload[self::QUANTITY]);
        return new self((int)$payload[self::PRODUCT_ID], new Quantity((int)$payload[self::QUANTITY]));
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): Quantity
    {
        return $this->quantity;
    }
}