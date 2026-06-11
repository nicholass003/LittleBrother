<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum;

enum LoadingScreenType : int{

    case UNKNOWN = 0;
    case START_LOADING_SCREEN = 1;
    case STOP_LOADING_SCREEN = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}