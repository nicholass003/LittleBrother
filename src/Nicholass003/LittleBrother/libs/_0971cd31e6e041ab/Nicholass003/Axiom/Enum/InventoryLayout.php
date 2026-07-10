<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum;

enum InventoryLayout : int{

    case NONE = 0;
    case SURVIVAL = 1;
    case RECIPE_BOOK = 2;
    case CREATIVE = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::NONE;
    }
}