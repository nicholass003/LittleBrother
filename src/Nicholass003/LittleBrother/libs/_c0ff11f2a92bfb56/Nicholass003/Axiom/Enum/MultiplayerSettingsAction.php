<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum;

enum MultiplayerSettingsAction : int{

    case UNKNOWN = -1;
    case ENABLE_MULTIPLAYER = 0;
    case DISABLE_MULTIPLAYER = 1;
    case REFRESH_JOIN_CODE = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}