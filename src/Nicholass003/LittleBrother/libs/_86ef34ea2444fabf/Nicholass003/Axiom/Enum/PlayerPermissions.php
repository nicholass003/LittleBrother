<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum;

enum PlayerPermissions : int{

    case UNKNOWN = -1;
    case VISITOR = 0;
    case MEMBER = 1;
    case OPERATOR = 2;
    case CUSTOM = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}