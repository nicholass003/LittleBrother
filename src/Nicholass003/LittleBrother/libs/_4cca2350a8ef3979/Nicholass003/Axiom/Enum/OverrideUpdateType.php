<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum;

enum OverrideUpdateType : int{

    case UNKNOWN = -1;
    case CLEAR_OVERRIDES = 0;
    case REMOVE_OVERRIDE = 1;
    case SET_INT_OVERRIDE = 2;
    case SET_FLOAT_OVERRIDE = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}