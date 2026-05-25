<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum;

enum InventoryLeftTab : int{

    case NONE = 0;
    case CONSTRUCTION = 1;
    case EQUIPMENT = 2;
    case ITEMS = 3;
    case NATURE = 4;
    case SEARCH = 5;
    case SURVIVAL = 6;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::NONE;
    }
}