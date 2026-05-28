<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Enum;

enum SimpleEventType : int{

    case UNKNOWN = 0;
	case TYPE_ENABLE_COMMANDS = 1;
	case TYPE_DISABLE_COMMANDS = 2;
	case TYPE_UNLOCK_WORLD_TEMPLATE_SETTINGS = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}