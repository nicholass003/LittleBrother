<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum;

enum PartyDestinationCookieIntent : string{

    case UNKNOWN = "";
    case NOTIFY = "Notify";
    case OPT_IN = "OptIn";
    case OPT_OUT = "OptOut";

    public static function safe(string $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}