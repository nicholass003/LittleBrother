<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum;

/** @since v859 */
enum GraphicsOverrideParameterType : int{

    case UNKNOWN = -1;
    case SKY_ZENITH_COLOR = 0;
	/** @since v898 */
    case SKY_HORIZON_COLOR = 1;
	/** @since v898 */
	case HORIZON_BLEND_MIN = 2;
	/** @since v898 */
	case HORIZON_BLEND_MAX = 3;
	/** @since v898 */
	case HORIZON_BLEND_START = 4;
	/** @since v898 */
	case HORIZON_BLEND_MIE_START = 5;
	/** @since v898 */
	case RAYLEIGH_STRENGTH = 6;
	/** @since v898 */
	case SUN_MIE_STRENGTH = 7;
	/** @since v898 */
	case MOON_MIE_STRENGTH = 8;
	/** @since v898 */
	case SUN_GLARE_SHAPE = 9;
	/** @since v924 */
	case CHLOROPHYLL = 10;
	/** @since v924 */
	case CDOM = 11;
	/** @since v924 */
	case SUSPENDED_SEDIMENT = 12;
	/** @since v924 */
	case WAVES_DEPTH = 13;
	/** @since v924 */
	case WAVES_FREQUENCY = 14;
	/** @since v924 */
	case WAVES_FREQUENCY_SCALING = 15;
	/** @since v924 */
	case WAVES_SPEED = 16;
	/** @since v924 */
	case WAVES_SPEED_SCALING = 17;
	/** @since v924 */
	case WAVES_SHAPE = 18;
	/** @since v924 */
	case WAVES_OCTAVES = 19;
	/** @since v924 */
	case WAVES_MIX = 20;
	/** @since v924 */
	case WAVES_PULL = 21;
	/** @since v924 */
	case WAVES_DIRECTION_INCREMENT = 22;
	/** @since v924 */
	case MIDTONES_CONTRAST = 23;
	/** @since v924 */
	case HIGHLIGHTS_CONTRAST = 24;
	/** @since v924 */
	case SHADOWS_CONTRAST = 25;
	/** @since v944 */
	case HIGHLIGHTS_GAIN = 26;
	/** @since v944 */
	case HIGHLIGHTS_GAMMA = 27;
	/** @since v944 */
	case HIGHLIGHTS_OFFSET = 28;
	/** @since v944 */
	case HIGHLIGHTS_SATURATION = 29;
	/** @since v944 */
	case MIDTONES_GAIN = 30;
	/** @since v944 */
	case MIDTONES_GAMMA = 31;
	/** @since v944 */
	case MIDTONES_OFFSET = 32;
	/** @since v944 */
	case MIDTONES_SATURATION = 33;
	/** @since v944 */
	case SHADOWS_GAIN = 34;
	/** @since v944 */
	case SHADOWS_GAMMA = 35;
	/** @since v944 */
	case SHADOWS_OFFSET = 36;
	/** @since v944 */
	case SHADOWS_SATURATION = 37;
	/** @since v944 */
	case HIGHLIGHTS_MIN = 38;
	/** @since v944 */
	case SHADOWS_MAX = 39;
	/** @since v944 */
	case TEMPERATURE = 40;
	/** @since v944 */
	case SUN_COLOR = 41;
	/** @since v944 */
	case SUN_ILLUMINANCE = 42;
	/** @since v944 */
	case MOON_COLOR = 43;
	/** @since v944 */
	case MOON_ILLUMINANCE = 44;
	/** @since v944 */
	case FLASH_COLOR = 45;
	/** @since v944 */
	case FLASH_ILLUMINANCE = 46;
	/** @since v944 */
	case AMBIENT_COLOR = 47;
	/** @since v944 */
	case AMBIENT_ILLUMINANCE = 48;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}