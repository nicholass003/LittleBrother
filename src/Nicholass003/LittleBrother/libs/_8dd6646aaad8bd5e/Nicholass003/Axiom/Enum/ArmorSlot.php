<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum;

enum ArmorSlot : int{

    case UNKNOWN = -1;
	case HEAD = 0;
	case TORSO = 1;
	case LEGS = 2;
	case FEET = 3;
	case BODY = 4;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}