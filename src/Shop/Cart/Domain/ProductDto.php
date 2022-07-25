<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain;

use DateTimeImmutable;

final class ProductDto
{
    public function __construct(
        private readonly int $id,
        private readonly ProductType $type,
        private readonly ?bool $isAvailable,
        private readonly ?int $quantity,
        private readonly ?DateTimeImmutable $presaleStartedAt,
        private readonly ?DateTimeImmutable $presaleEndedAt
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): ProductType
    {
        return $this->type;
    }

    public function isAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function getPresaleStartedAt(): ?DateTimeImmutable
    {
        return $this->presaleStartedAt;
    }

    public function getPresaleEndedAt(): ?DateTimeImmutable
    {
        return $this->presaleEndedAt;
    }
}