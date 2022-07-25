<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Domain;

enum ProductType
{
    case STANDARD;
    case ACCESSORY;
    case LIMITED;
}