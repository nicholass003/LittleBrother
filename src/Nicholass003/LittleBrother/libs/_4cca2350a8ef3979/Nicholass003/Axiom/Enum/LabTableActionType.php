<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum;

enum LabTableActionType : int{

    case UNKNOWN = -1;
    case START_COMBINE = 0;
    case START_REACTION = 1;
    case RESET = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}