<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain;

use DateTimeImmutable;
use SuperUmbrella\Shop\Shared\DateTimeHelper;
use Webmozart\Assert\Assert;

final class Cart
{
    private const ID = 'id';
    private const USER_ID = 'user_id';
    private const ITEM_LIST = 'item_list';

    private ?DateTimeImmutable $boughtAt = null;

    private function __construct(private ?int $id, private $userId, private readonly ItemList $itemList)
    {
    }

    public static function create(int $userId): self
    {
        return new self(null, $userId, new ItemList());
    }

    public static function ofPayload(array $payload): self
    {
        Assert::inArray(self::ID, $payload);
        Assert::integerish($payload[self::ID]);
        Assert::inArray(self::USER_ID, $payload);
        Assert::integerish($payload[self::USER_ID]);
        Assert::inArray(self::ITEM_LIST, $payload);
        Assert::isArray($payload[self::ITEM_LIST]);
        $itemList = ItemList::ofPayload($payload[self::ITEM_LIST]);
        return new self((int)$payload[self::ID], (int)$payload[self::USER_ID], $itemList);
    }

    public function add(ProductDto $product, int $quantity, bool $userIsPremium): bool
    {
        if ($this->boughtAt) {
            return false;
        }
        return $this->itemList->add($product, $quantity, $userIsPremium);
    }

    public function updateQuantity(ProductDto $product, int $quantity, bool $userIsPremium): bool
    {
        if ($this->boughtAt) {
            return false;
        }
        return $this->itemList->updateQuantity($product, $quantity, $userIsPremium);
    }

    public function remove(int $productId): bool
    {
        if ($this->boughtAt) {
            return false;
        }
        $this->itemList->remove($productId);
        return true;
    }

    public function buy(): bool
    {
        $this->boughtAt = DateTimeHelper::now();
        return true;
    }
}