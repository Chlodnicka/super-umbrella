<?php

declare(strict_types=1);

namespace SuperUmbrella\Address\xNal;

final class CrudeAddressDetails
{
    /**
     * @param string[] $addressLines
     */
    public function __construct(private array $addressLines = [])
    {
    }

    public function __toString(): string
    {
        return implode(', ', $this->addressLines);
    }
}