<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum;

enum RequestAbilityType : int{

    case UNKNOWN = 0;
    case FLYING = 9;
    case NOCLIP = 17;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}