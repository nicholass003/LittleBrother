<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum;

enum AgentActionType : int{

    case NONE = 0;
    case ATTACK = 1;
    case COLLECT = 2;
    case DESTROY = 3;
    case DETECT_REDSTONE = 4;
    case DETECT_OBSTACLE = 5;
    case DROP = 6;
    case DROP_ALL = 7;
    case INSPECT = 8;
    case INSPECT_DATA = 9;
    case INSPECT_ITEM_COUNT = 10;
    case INSPECT_ITEM_DETAIL = 11;
    case INSPECT_ITEM_SPACE = 12;
    case MOVE = 13;
    case PLACE_BLOCK = 14;
    case TILL = 15;
    case TRANSFER_ITEM_TO = 16;
    case TURN = 17;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::NONE;
    }
}