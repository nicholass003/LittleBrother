<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum;

enum InventoryActionSourceType : int{

    case UNKNOWN = -1;
    case CONTAINER = 0;
    case WORLD = 2;
    case CREATIVE = 3;
    case TODO = 99999;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}