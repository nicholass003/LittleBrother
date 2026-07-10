<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum;

enum GraphicsMode : int{

    case UNKNOWN = -1;
    case SIMPLE = 0;
    case FANCY = 1;
    case ADVANCED = 2;
    case RAY_TRACED = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}