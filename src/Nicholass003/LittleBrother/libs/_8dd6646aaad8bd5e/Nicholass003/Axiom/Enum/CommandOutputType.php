<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum;

enum CommandOutputType : int{

    case UNKNOWN = 0;
    case LAST = 1;
    case SILENT = 2;
    case ALL = 3;
    case DATA_SET = 4;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }

    public static function fromString(string $value) : self{
        return match($value){
            "lastoutput" => self::LAST,
            "silent" => self::SILENT,
            "alloutput" => self::ALL,
            "dataset" => self::DATA_SET,
            default => self::UNKNOWN,
        };
    }

    public function toString() : string{
        return match($this){
            self::LAST => "lastoutput",
            self::SILENT => "silent",
            self::ALL => "alloutput",
            self::DATA_SET => "dataset",
            self::UNKNOWN => "unknown",
        };
    }
}