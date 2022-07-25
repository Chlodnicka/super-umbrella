<?php

declare(strict_types=1);

namespace SuperUmbrella\Address\xNal\Simple;

final class AdministrativeArea
{
    public function __construct(private string $addressLine, private Locality $locality)
    {
    }

    public function __toString(): string
    {
        return "{$this->locality}, {$this->addressLine}";
    }
}