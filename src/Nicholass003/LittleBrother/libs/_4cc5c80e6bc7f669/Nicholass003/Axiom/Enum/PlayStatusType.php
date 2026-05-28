<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum;

enum PlayStatusType : int{

    case UNKNOWN = -1;
	case LOGIN_SUCCESS = 0;
	case LOGIN_FAILED_CLIENT = 1;
	case LOGIN_FAILED_SERVER = 2;
	case PLAYER_SPAWN = 3;
	case LOGIN_FAILED_INVALID_TENANT = 4;
	case LOGIN_FAILED_VANILLA_EDU = 5;
	case LOGIN_FAILED_EDU_VANILLA = 6;
	case LOGIN_FAILED_SERVER_FULL = 7;
	case LOGIN_FAILED_EDITOR_VANILLA = 8;
	case LOGIN_FAILED_VANILLA_EDITOR = 9;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}