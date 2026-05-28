<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum;

enum ItemDescriptorType : int{

    case UNKNOWN = 0;
	case INT_ID_META = 1;
	case MOLANG = 2;
	case TAG = 3;
	case STRING_ID_META = 4;
	case COMPLEX_ALIAS = 5;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}