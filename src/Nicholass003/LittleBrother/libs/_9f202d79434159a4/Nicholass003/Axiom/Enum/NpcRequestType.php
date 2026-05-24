<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum;

enum NpcRequestType : int{

    case UNKNOWN = -1;
    case SET_ACTIONS = 0;
    case EXECUTE_ACTION = 1;
    case EXECUTE_CLOSING_COMMANDS = 2;
    case SET_NAME = 3;
    case SET_SKIN = 4;
    case SET_INTERACTION_TEXT = 5;
    case EXECUTE_OPENING_COMMANDS = 6;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}