<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Registry;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum\LevelSoundType;

final class LevelSoundTypeRegistry{

    /**
     * @var array<string, LevelSoundType>
     */
    private static array $fromString = [];

    /**
     * @var array<int, string>
     */
    private static array $toString = [];

    public static function fromString(string $value) : LevelSoundType{
        $value = strtolower($value);

        if(isset(self::$fromString[$value])){
            return self::$fromString[$value];
        }

        $normalized = strtoupper(str_replace('.', '_', $value));

        $enum = LevelSoundType::tryFromName($normalized);

        if($enum !== null){
            self::$fromString[$value] = $enum;
            self::$toString[$enum->value] = $value;

            return $enum;
        }

        return LevelSoundType::UNKNOWN;
    }

    public static function toString(LevelSoundType $type) : string{
        if(isset(self::$toString[$type->value])){
            return self::$toString[$type->value];
        }

        $value = strtolower(str_replace('_', '.', $type->name));

        self::$toString[$type->value] = $value;
        self::$fromString[$value] = $type;

        return $value;
    }
}