<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum;

enum TextureShiftAction : int{

    case UNKNOWN = -1;
	case INVALID = 0;
	case INITIALIZE = 1;
	case START = 2;
	case SET_ENABLED = 3;
	case SYNC = 4;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}