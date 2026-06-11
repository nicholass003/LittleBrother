<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum;

enum SetScoreboardIdentityType : int{

    case UNKNOWN = -1;
    case REGISTER_IDENTITY = 0;
    case CLEAR_IDENTITY = 1;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}