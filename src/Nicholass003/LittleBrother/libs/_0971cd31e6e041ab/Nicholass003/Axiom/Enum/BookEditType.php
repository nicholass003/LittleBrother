<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum;

enum BookEditType : int{

    case UNKNOWN = -1;
    case REPLACE_PAGE = 0;
    case ADD_PAGE = 1;
    case DELETE_PAGE = 2;
    case SWAP_PAGES = 3;
    case SIGN_BOOK = 4;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}