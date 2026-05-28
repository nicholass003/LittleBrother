<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum;

enum SoundEventType : int{

    case UNKNOWN = -1;
    case STOP = 0;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }

    public static function fromString(string $value) : self{
        return match(strtolower($value)){
            "stop" => self::STOP,
            default => self::UNKNOWN,
        };
    }

    public function toString() : string{
        $value = match($this){
            self::STOP => "stop",
            self::UNKNOWN => "unknown",
        };
        return ucwords($value);
    }
}