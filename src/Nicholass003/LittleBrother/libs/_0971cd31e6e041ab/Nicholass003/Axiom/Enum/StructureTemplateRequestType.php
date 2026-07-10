<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum;

enum StructureTemplateRequestType : int{

    case UNKNOWN = -1;
    case EXPORT_FROM_SAVE_MODE = 1;
    case EXPORT_FROM_LOAD_MODE = 2;
    case QUERY_SAVED_STRUCTURE = 3;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}