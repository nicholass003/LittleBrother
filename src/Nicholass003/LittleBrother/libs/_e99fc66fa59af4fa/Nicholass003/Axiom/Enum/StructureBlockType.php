<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum;

enum StructureBlockType : int{

    case UNKNOWN = -1;
    case DATA = 0;
    case SAVE = 1;
    case LOAD = 2;
    case CORNER = 3;
    case INVALID = 4;
    case EXPORT = 5;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}