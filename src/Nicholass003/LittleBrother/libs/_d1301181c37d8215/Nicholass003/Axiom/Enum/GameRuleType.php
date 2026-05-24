<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum;

enum GameRuleType : int{

    case UNKNOWN = -1;
    case BOOL = 1;
    case INT = 2;
    case FLOAT = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}