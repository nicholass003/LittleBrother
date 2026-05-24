<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum;

enum DataStoreType : int{

    case UNKNOWN = -1;
    case UPDATE = 0;
    case CHANGE = 1;
    case REMOVAL = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}