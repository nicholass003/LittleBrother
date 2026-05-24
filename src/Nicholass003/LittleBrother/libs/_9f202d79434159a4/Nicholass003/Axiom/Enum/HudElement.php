<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Enum;

enum HudElement : int{

    case UNKNOWN = -1;
    case PAPER_DOLL = 0;
    case ARMOR = 1;
    case TOOLTIPS = 2;
    case TOUCH_CONTROLS = 3;
    case CROSSHAIR = 4;
    case HOTBAR = 5;
    case HEALTH = 6;
    case XP = 7;
    case FOOD = 8;
    case AIR_BUBBLES = 9;
    case HORSE_HEALTH = 10;
    case STATUS_EFFECTS = 11;
    case ITEM_TEXT = 12;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}