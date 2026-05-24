<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum;

enum SimulationType : int{

    case UNKNOWN = -1;
	case GAME = 0;
	case EDITOR = 1;
	case TEST = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}