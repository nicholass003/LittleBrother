<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Enum;

enum ClientboundDebugRendererType : int{

    case UNKNOWN = -1;
    case CLEAR = 0;
    case ADD_CUBE = 1;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }

    public static function fromString(string $value) : self{
        return match($value){
            "cleardebugmarkers" => self::CLEAR,
            "adddebugmarkercube" => self::ADD_CUBE,
            default => self::UNKNOWN,
        };
    }

    public function toString() : string{
        return match($this){
            self::CLEAR => "cleardebugmarkers",
            self::ADD_CUBE => "adddebugmarkercube",
            self::UNKNOWN => "unknown",
        };
    }
}