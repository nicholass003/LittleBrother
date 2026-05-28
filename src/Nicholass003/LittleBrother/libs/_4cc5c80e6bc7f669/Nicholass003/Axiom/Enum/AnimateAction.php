<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum;

enum AnimateAction : int{

    case UNKNOWN = 0;
    case SWING_ARM = 1;
    case WAKE_UP = 3;
    case CRITICAL_HIT = 4;
    case MAGIC_CRITICAL_HIT = 5;

    /** @deprecated v898 */
    case ROW_RIGHT = 128;
    /** @deprecated v898 */
    case ROW_LEFT = 129;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}