<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum;

enum UpdateBlockSyncedType : int{

    case UNKNOWN = -1;
    case NONE = 0;
    case CREATE = 1;
    case DESTROY = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}