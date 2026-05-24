<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum;

enum StructureTemplateRequestType : int{

    case UNKNOWN = -1;
    case EXPORT_FROM_SAVE_MODE = 1;
    case EXPORT_FROM_LOAD_MODE = 2;
    case QUERY_SAVED_STRUCTURE = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}