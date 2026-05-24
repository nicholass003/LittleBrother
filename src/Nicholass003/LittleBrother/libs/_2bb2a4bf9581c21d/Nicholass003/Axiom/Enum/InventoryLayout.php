<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum;

enum InventoryLayout : int{

    case NONE = 0;
    case SURVIVAL = 1;
    case RECIPE_BOOK = 2;
    case CREATIVE = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::NONE;
    }
}