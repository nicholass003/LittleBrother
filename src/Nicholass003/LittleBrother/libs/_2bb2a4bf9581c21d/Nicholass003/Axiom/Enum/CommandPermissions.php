<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Enum;

enum CommandPermissions : int{

    case UNKNOWN = -1;
	case NORMAL = 0;
	case OPERATOR = 1;
	case AUTOMATION = 2;
	case HOST = 3;
	case OWNER = 4;
	case INTERNAL = 5;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }

    public static function fromString(string $value) : self{
        return match($value){
            "any" => self::NORMAL,
            "gamedirectors" => self::OPERATOR,
            "admin" => self::AUTOMATION,
            "host" => self::HOST,
            "owner" => self::OWNER,
            "internal" => self::INTERNAL,
            default => self::UNKNOWN
        };
    }

    public function toString() : string{
        return match($this){
            self::NORMAL => "any",
            self::OPERATOR => "gamedirectors",
            self::AUTOMATION => "admin",
            self::HOST => "host",
            self::OWNER => "owner",
            self::INTERNAL => "internal",
            self::UNKNOWN => "unknown",
        };
    }
}