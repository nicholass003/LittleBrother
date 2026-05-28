<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum;

enum UpdateBlockSyncedType : int{

    case UNKNOWN = -1;
    case NONE = 0;
    case CREATE = 1;
    case DESTROY = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}