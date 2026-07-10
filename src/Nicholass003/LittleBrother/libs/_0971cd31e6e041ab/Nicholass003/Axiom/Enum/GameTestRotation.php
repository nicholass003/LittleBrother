<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum;

enum GameTestRotation : int{

    case UNKNOWN = -1;
    case ROTATION_0 = 0;
    case ROTATION_90 = 1;
    case ROTATION_180 = 2;
    case ROTATION_270 = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}