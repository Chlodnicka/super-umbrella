<?php

declare(strict_types=1);

namespace SuperUmbrella\Address\xNal\Simple;

final class Locality
{
    public function __construct(
        private string $addressLine,
        private Thoroughfare $thoroughfare,
        private PostalCode $postalCode
    ) {
    }

    public function __toString(): string
    {
        return "{$this->addressLine}, {$this->thoroughfare}, {$this->postalCode}";
    }
}