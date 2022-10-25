<?php

declare(strict_types=1);

namespace SuperUmbrella\DsTest;

use Ds\Vector;

final class DsService
{
    public function createVector(): void
    {
        $vector = new Vector([1, 2, 3, 4, 5]);
        $vector->first();
        $vector2 = $vector->filter(static function (int $x) {
            return $x % 2;
        });
        $vector->first();
        $vector2->first();
        $vector->contains(1);
        $vector->get(3);
        $vector->count();
        $vector->last();
        $vector->find(5);
        $vector->apply(static function (int $x) {
            return $x * 2;
        });
        $vector->find(5);
        $vector->find(10);
        $vector->contains(1);
    }
}