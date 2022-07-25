<?php

declare(strict_types=1);

namespace SuperUmbrella\Address\xNal\Simple;

final class PostalCode
{
    public function __construct(private string $addressLine)
    {
    }

    public function __toString(): string
    {
        return $this->addressLine;
    }
}