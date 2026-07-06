<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum;

enum DataStoreValueType : int{

    case UNKNOWN = -1;
    case DOUBLE = 0;
    case BOOL = 1;
    case STRING = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}