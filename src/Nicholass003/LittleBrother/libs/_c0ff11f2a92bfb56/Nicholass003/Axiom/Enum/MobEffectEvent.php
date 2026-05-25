<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum;

enum MobEffectEvent : int{

    case UNKNOWN = 0;
    case ADD = 1;
    case MODIFY = 2;
    case REMOVE = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}