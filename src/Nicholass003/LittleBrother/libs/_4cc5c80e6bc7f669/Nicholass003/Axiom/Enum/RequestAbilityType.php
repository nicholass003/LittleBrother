<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum;

enum RequestAbilityType : int{

    case UNKNOWN = 0;
    case FLYING = 9;
    case NOCLIP = 17;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}