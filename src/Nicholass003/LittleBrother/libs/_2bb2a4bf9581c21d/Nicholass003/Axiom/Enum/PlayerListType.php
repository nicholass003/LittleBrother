<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum;

enum PlayerListType : int{

    case UNKNOWN = -1;
    case ADD = 0;
    case REMOVE = 1;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}