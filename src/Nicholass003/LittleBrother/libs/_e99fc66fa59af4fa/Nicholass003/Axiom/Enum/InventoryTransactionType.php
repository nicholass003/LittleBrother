<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum;

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