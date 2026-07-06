<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum;

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