<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain;

use DateTimeImmutable;
use SuperUmbrella\Shop\Shared\DateTimeHelper;
use SuperUmbrella\Shop\Shared\Quantity;
use Webmozart\Assert\Assert;

final class Cart
{
    private const ID = 'id';
    private const ITEM_LIST = 'item_list';
    private const IS_ACTIVE = 'is_active';
    private const BOUGHT_AT = 'bought_at';

    private function __construct(
        private readonly int $id,
        private readonly ItemList $itemList,
        private bool $isActive,
        private ?DateTimeImmutable $boughtAt = null
    ) {
    }

    public static function create(int $id): self
    {
        return new self($id, ItemList::create(), true);
    }

    public static function ofPayload(array $payload): self
    {
        Assert::inArray(self::ID, $payload);
        Assert::integerish($payload[self::ID]);
        Assert::inArray(self::ITEM_LIST, $payload);
        Assert::isArray($payload[self::ITEM_LIST]);
        Assert::inArray(self::IS_ACTIVE, $payload);
        Assert::boolean($payload[self::IS_ACTIVE]);
        Assert::inArray(self::BOUGHT_AT, $payload);

        $boughtAt = $payload[self::BOUGHT_AT] ? DateTimeHelper::from($payload[self::BOUGHT_AT]) : null;
        $itemList = ItemList::ofPayload($payload[self::ITEM_LIST]);

        return new self((int)$payload[self::ID], $itemList,
            (bool)$payload[self::IS_ACTIVE], $boughtAt);
    }

    public function add(ProductDto $product, Quantity $quantity, bool $userIsPremium): bool
    {
        if (!$this->isActive) {
            return false;
        }
        return $this->itemList->add($product, $quantity, $userIsPremium);
    }

    public function updateQuantity(ProductDto $product, Quantity $quantity, bool $userIsPremium): bool
    {
        if (!$this->isActive) {
            return false;
        }
        return $this->itemList->updateQuantity($product, $quantity, $userIsPremium);
    }

    public function remove(int $productId): bool
    {
        if (!$this->isActive) {
            return false;
        }
        $this->itemList->remove($productId);
        return true;
    }

    public function buy(): bool
    {
        $this->boughtAt = DateTimeHelper::now();
        $this->isActive = false;
        return true;
    }

    public function deactivate(): bool
    {
        $this->isActive = false;
        return true;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->itemList->get();
    }
}