<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum;

enum GameRuleType : int{

    case UNKNOWN = -1;
    case BOOL = 1;
    case INT = 2;
    case FLOAT = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}