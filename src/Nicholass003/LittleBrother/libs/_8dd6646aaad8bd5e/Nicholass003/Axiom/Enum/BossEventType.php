<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum;

enum BossEventType : int{

    case UNKNOWN = -1;
    case SHOW = 0;
    case REGISTER_PLAYER = 1;
    case HIDE = 2;
    case UNREGISTER_PLAYER = 3;
    case HEALTH_PERCENT = 4;
    case TITLE = 5;
    case PROPERTIES = 6;
    case TEXTURE = 7;
    case QUERY = 8;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}