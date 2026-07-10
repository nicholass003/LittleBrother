<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Registry;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\LevelSoundType;

final class LevelSoundTypeRegistry{

    /**
     * @var array<string, LevelSoundType>
     */
    private static array $fromString = [];

    /**
     * @var array<int, string>
     */
    private static array $toString = [];

    /**
     * Loads a Bedrock sound identifier mapping into the registry.
     *
     * Populates bidirectional lookups between sound identifiers and
     * {@see LevelSoundType} values. Entries with unknown enum values
     * are ignored.
     *
     * @param array<string, int> $mapping Map of sound identifier => sound event ID.
     */
    public static function loadMappings(array $mapping) : void{
        foreach($mapping as $stringId => $intValue){
            $enum = LevelSoundType::tryFrom($intValue);

            if($enum !== null){
                self::$fromString[$stringId] = $enum;
                self::$toString[$intValue] = $stringId;
            }
        }
    }

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