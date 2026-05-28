<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum;

enum InteractAction : int{

    case UNKNOWN = 0;
    case INTERACT = 1;
    case DAMAGE = 2;
    case LEAVE_VEHICLE = 3;
    case MOUSEOVER = 4;
    case NPC_OPEN = 5;
    case OPEN_INVENTORY = 6;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}