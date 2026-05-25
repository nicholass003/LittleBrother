<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum;

enum UnlockedRecipesType : int{

    case UNKNOWN = -1;
    case EMPTY = 0;
    case INITIALLY_UNLOCKED = 1;
    case NEWLY_UNLOCKED = 2;
    case REMOVE = 3;
    case REMOVE_ALL = 4;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}