<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum;

enum AgentAnimationType : int{

    case UNKNOWN = -1;
    case ARM_SWING = 0;
    case SHRUG = 1;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}