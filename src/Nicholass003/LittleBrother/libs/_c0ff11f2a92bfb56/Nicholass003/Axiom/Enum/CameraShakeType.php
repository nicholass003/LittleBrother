<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum;

enum CameraShakeType : int{

    case UNKNOWN = -1;
    case POSITIONAL = 0;
    case ROTATIONAL = 1;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}