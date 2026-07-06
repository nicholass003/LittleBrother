<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum;

enum MetadataPropertyType : int{

    case UNKNOWN = -1;
    case BYTE = 0;
    case SHORT = 1;
    case INT = 2;
    case FLOAT = 3;
    case STRING = 4;
    case COMPOUND_TAG = 5;
    case BLOCK_POS = 6;
    case LONG = 7;
    case VEC3 = 8;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}