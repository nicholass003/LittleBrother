<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum;

enum TriggerType : int{

    case INVALID = -1;
    case UNKNOWN = 0;
    case PLAYER_INPUT = 1;
    case SIMULATION_TICK = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::INVALID;
    }
}