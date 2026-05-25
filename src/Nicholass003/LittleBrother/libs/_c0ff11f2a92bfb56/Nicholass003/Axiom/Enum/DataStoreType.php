<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum;

enum DataStoreType : int{

    case UNKNOWN = -1;
    case UPDATE = 0;
    case CHANGE = 1;
    case REMOVAL = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}