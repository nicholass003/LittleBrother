<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum;

enum PackSettingType : int{

    case UNKNOWN = -1;
    case FLOAT = 0;
    case BOOL = 1;
    case STRING = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}