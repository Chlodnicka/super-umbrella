<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Application;

use Exception;
use Throwable;

final class CartException extends Exception
{
    public static function cannotCreateCart(Throwable $exception): self
    {
        return new self('Cannot create cart');
    }

    public static function cannotSaveCart(Throwable $exception): self
    {
        return new self('Cannot save cart');
    }
}