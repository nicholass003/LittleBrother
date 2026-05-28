<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum;

enum CameraAimAssistTargetMode : int{

    case UNKNOWN = -1;
    case ANGLE = 0;
    case DISTANCE = 1;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}