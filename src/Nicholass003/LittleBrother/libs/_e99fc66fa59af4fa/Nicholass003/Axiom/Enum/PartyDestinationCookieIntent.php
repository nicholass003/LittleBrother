<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum;

enum PartyDestinationCookieIntent : string{

    case UNKNOWN = "";
    case NOTIFY = "Notify";
    case OPT_IN = "OptIn";
    case OPT_OUT = "OptOut";

    public static function safe(string $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}