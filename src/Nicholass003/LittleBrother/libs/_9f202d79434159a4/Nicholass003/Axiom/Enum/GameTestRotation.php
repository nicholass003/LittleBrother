<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum;

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