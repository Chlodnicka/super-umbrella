<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Shared\Exception;

final class QuantityValueCannotBeLessThanZero extends CustomException
{
    public function __construct()
    {
        parent::__construct('Quantity cannot be less ten zero!');
    }
}