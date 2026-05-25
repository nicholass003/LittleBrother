<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum;

enum ResourcePackClientResponseStatus : int{

    case UNKNOWN = 0;
	case STATUS_REFUSED = 1;
	case STATUS_SEND_PACKS = 2;
	case STATUS_HAVE_ALL_PACKS = 3;
	case STATUS_COMPLETED = 4;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}