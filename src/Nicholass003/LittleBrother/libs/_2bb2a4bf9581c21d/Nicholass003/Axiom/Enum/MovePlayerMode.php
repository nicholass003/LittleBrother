<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum;

enum MovePlayerMode : int{

    case UNKNOWN = -1;
    case MODE_NORMAL = 0;
    case MODE_RESET = 1;
    case MODE_TELEPORT = 2;
    case MODE_PITCH = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}