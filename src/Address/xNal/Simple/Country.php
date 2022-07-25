<?php

declare(strict_types=1);

namespace SuperUmbrella\Address\xNal\Simple;

final class Country
{
    public function __construct(private string $addressLine, private AdministrativeArea $administrativeArea)
    {
    }

    public function __toString(): string
    {
        return "{$this->administrativeArea}, {$this->addressLine}";
    }
}