<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum;

enum ContainerIds : int{

    case NONE = -1;
    case INVENTORY = 0;
    case FIRST = 1;
    case LAST = 100;
    case OFFHAND = 119;
    case ARMOR = 120;
    case HOTBAR = 122;
    case FIXED_INVENTORY = 123;
    case UI = 124;
    case CONTAINER_ID_REGISTRY = 125;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::NONE;
    }
}