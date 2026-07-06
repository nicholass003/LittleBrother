<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum;

enum SetScoreboardIdentityType : int{

    case UNKNOWN = -1;
    case REGISTER_IDENTITY = 0;
    case CLEAR_IDENTITY = 1;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}