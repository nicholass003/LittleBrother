<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum;

enum LabTableActionType : int{

    case UNKNOWN = -1;
    case START_COMBINE = 0;
    case START_REACTION = 1;
    case RESET = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}