<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum;

enum SubChunkRequestResult : int{

    case UNKNOWN = 0;
    case SUCCESS = 1;
    case NO_SUCH_CHUNK = 2;
    case WRONG_DIMENSION = 3;
    case NULL_PLAYER = 4;
    case Y_INDEX_OUT_OF_BOUNDS = 5;
    case SUCCESS_ALL_AIR = 6;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}