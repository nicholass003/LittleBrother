<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Enum;

enum GameMode : int{

    case UNKNOWN = -1;
	case SURVIVAL = 0;
	case CREATIVE = 1;
	case ADVENTURE = 2;
	case SURVIVAL_VIEWER = 3;
	case CREATIVE_VIEWER = 4;
	case DEFAULT = 5;
	case SPECTATOR = 6;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}