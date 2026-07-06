<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum;

enum PartyDestinationCookieIntent : string{

    case UNKNOWN = "";
    case NOTIFY = "Notify";
    case OPT_IN = "OptIn";
    case OPT_OUT = "OptOut";

    public static function safe(string $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}