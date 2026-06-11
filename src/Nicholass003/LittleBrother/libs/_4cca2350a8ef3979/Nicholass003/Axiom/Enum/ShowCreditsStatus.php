<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum;

enum ShowCreditsStatus : int{

    case UNKNOWN = -1;
    case START_CREDITS = 0;
    case END_CREDITS = 1;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}