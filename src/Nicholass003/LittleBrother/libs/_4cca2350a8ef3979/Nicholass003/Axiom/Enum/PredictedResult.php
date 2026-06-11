<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum;

enum PredictedResult : int{

    case UNKNOWN = -1;
    case FAILURE = 0;
    case SUCCESS = 1;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}