<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Shared;

use SuperUmbrella\Shop\Shared\Exception\QuantityValueCannotBeLessThanZero;

final class Quantity
{
    private int $value;

    /**
     * @throws QuantityValueCannotBeLessThanZero
     */
    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new QuantityValueCannotBeLessThanZero();
        }
        $this->value = $value;
    }

    /**
     * @throws QuantityValueCannotBeLessThanZero
     */
    public function add(Quantity $quantity): self
    {
        return new Quantity($quantity->value + $this->value);
    }

    /**
     * @throws QuantityValueCannotBeLessThanZero
     */
    public function subtract(Quantity $quantity): self
    {
        return new Quantity($this->value - $quantity->value);
    }

    public function equals(Quantity $quantity): bool
    {
        return $this->value === $quantity->value;
    }
}