<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum;

enum TriggerType : int{

    case INVALID = -1;
    case UNKNOWN = 0;
    case PLAYER_INPUT = 1;
    case SIMULATION_TICK = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::INVALID;
    }
}