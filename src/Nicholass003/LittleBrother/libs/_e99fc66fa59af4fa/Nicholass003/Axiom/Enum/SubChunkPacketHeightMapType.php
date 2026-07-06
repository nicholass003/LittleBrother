<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum;

enum SubChunkPacketHeightMapType : int{

    case UNKNOWN = -1;
    case NO_DATA = 0;
    case DATA = 1;
    case ALL_TOO_HIGH = 2;
    case ALL_TOO_LOW = 3;
    case ALL_COPIED = 4;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}