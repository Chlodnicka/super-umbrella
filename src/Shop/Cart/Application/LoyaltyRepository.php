<?php

namespace SuperUmbrella\Shop\Cart\Application;

interface LoyaltyRepository
{
    public function isUserPremium(int $userId);
}