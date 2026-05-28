<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum;

enum InventoryRightTab : int{

    case NONE = 0;
    case FULL_SCREEN = 1;
    case CRAFTING = 2;
    case ARMOR = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::NONE;
    }
}