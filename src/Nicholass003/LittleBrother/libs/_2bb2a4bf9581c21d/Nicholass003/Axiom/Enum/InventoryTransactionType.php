<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum;

enum InventoryTransactionType : int{

    case UNKNOWN = -1;
    case NORMAL = 0;
    case MISMATCH = 1;
    case USE_ITEM = 2;
    case USE_ITEM_ON_ENTITY = 3;
    case RELEASE_ITEM = 4;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}