<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum;

enum LessonProgressAction : int{

    case UNKNOWN = -1;
    case START = 0;
    case FINISH = 1;
    case RESTART = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}