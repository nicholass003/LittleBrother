<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum;

enum TextType : int{

    case UNKNOWN = -1;
    case RAW = 0;
    case CHAT = 1;
    case TRANSLATION = 2;
    case POPUP = 3;
    case JUKEBOX_POPUP = 4;
    case TIP = 5;
    case SYSTEM = 6;
    case WHISPER = 7;
    case ANNOUNCEMENT = 8;
    case JSON_WHISPER = 9;
    case JSON = 10;
    case JSON_ANNOUNCEMENT = 11;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}