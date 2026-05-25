<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum;

enum ControlScheme : int{

    case UNKNOWN = -1;
    case LOCKED_PLAYER_RELATIVE_STRAFE = 0;
    case CAMERA_RELATIVE = 1;
    case CAMERA_RELATIVE_STRAFE = 2;
    case PLAYER_RELATIVE = 3;
    case PLAYER_RELATIVE_STRAFE = 4;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}