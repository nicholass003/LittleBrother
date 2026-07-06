<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum;

enum InventoryRightTab : int{

    case NONE = 0;
    case FULL_SCREEN = 1;
    case CRAFTING = 2;
    case ARMOR = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::NONE;
    }
}