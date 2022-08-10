<?php

namespace SuperUmbrella\Shop\Cart\Application;

use SuperUmbrella\Shop\Shared\UserId;

interface LoyaltyRepository
{
    public function isUserPremium(UserId $userId);
}