<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum;

enum RequestAbilityType : int{

    case UNKNOWN = 0;
    case FLYING = 9;
    case NOCLIP = 17;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}