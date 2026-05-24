<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum;

enum LabTableActionType : int{

    case UNKNOWN = -1;
    case START_COMBINE = 0;
    case START_REACTION = 1;
    case RESET = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}