<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum;

enum ShowStoreOfferRedirectType : int{

    case UNKNOWN = -1;
	case MARKETPLACE = 0;
	case DRESSING_ROOM = 1;
	case THIRD_PARTY_SERVER_PAGE = 2;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}