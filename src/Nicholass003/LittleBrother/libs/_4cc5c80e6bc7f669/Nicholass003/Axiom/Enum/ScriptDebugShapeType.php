<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum;

enum ScriptDebugShapeType : int{

    case UNKNOWN = -1;
    case LINE = 0;
    case BOX = 1;
    case SPHERE = 2;
    case CIRCLE = 3;
    case TEXT = 4;
    case ARROW = 5;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}