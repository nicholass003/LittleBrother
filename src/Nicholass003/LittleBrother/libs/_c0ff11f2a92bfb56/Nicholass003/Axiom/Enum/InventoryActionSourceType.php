<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum;

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