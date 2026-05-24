<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum;

enum EntityLinkType : int{

    case UNKNOWN = -1;
    case REMOVE = 0;
    case RIDER = 1;
    case PASSENGER = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}