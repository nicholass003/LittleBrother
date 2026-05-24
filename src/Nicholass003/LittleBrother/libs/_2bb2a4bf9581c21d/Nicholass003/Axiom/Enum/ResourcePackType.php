<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum;

enum ResourcePackType : int{

    case INVALID = 0;
    case ADDON = 1;
    case CACHED = 2;
    case COPY_PROTECTED = 3;
    case BEHAVIORS = 4;
    case PERSONA_PIECE = 5;
    case RESOURCES = 6;
    case SKINS = 7;
    case WORLD_TEMPLATE = 8;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::INVALID;
    }
}