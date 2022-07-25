<?php

declare(strict_types=1);

namespace SuperUmbrella\Address\xNal;

final class SimpleAddressDetails
{
    public function __construct(private Country $country)
    {
    }
}