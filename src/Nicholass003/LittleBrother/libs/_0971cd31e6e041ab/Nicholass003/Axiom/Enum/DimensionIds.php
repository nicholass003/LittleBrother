<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum;

enum DimensionIds : int{

    case UNKNOWN = -1;
	case OVERWORLD = 0;
	case NETHER = 1;
	case THE_END = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}