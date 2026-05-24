<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Enum;

/** @since v859 */
enum GraphicsOverrideParameterType : int{

    case UNKNOWN = -1;
    case SKY_ZENITH_COLOR = 0;

    case SKY_HORIZON_COLOR = 1;
	case HORIZON_BLEND_MIN = 2;
	case HORIZON_BLEND_MAX = 3;
	case HORIZON_BLEND_START = 4;
	case HORIZON_BLEND_MIE_START = 5;
	case RAYLEIGH_STRENGTH = 6;
	case SUN_MIE_STRENGTH = 7;
	case MOON_MIE_STRENGTH = 8;
	case SUN_GLARE_SHAPE = 9;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}