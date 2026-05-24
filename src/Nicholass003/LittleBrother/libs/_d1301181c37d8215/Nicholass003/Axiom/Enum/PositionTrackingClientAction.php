<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum;

enum PositionTrackingClientAction : int{

    case UNKNOWN = -1;
    case QUERY = 0;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}