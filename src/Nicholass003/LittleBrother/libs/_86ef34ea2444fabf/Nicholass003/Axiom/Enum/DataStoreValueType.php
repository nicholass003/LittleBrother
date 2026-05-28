<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum;

enum DataStoreValueType : int{

    case UNKNOWN = -1;
    case DOUBLE = 0;
    case BOOL = 1;
    case STRING = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}