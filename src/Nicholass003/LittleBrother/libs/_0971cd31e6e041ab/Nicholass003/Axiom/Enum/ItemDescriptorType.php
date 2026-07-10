<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum;

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