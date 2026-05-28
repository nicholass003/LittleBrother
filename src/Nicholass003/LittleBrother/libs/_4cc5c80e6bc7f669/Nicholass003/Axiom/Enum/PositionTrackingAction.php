<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum;

enum PositionTrackingAction : int{

    case UNKNOWN = -1;
    case UPDATE = 0;
    case DESTROY = 1;
    case NOT_FOUND = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}