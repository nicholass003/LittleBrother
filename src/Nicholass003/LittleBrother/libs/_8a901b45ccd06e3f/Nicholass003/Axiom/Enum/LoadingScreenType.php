<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum;

enum LoadingScreenType : int{

    case UNKNOWN = 0;
    case START_LOADING_SCREEN = 1;
    case STOP_LOADING_SCREEN = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}