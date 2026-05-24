<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum;

enum LoadingScreenType : int{

    case UNKNOWN = 0;
    case START_LOADING_SCREEN = 1;
    case STOP_LOADING_SCREEN = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}