<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum;

enum CommandOriginType : int{

    case UNKNOWN = -1;
    case PLAYER = 0;
    case BLOCK = 1;
    case MINECART_BLOCK = 2;
    case DEV_CONSOLE = 3;
    case TEST = 4;
    case AUTOMATION_PLAYER = 5;
    case CLIENT_AUTOMATION = 6;
    case DEDICATED_SERVER = 7;
    case ENTITY = 8;
    case VIRTUAL = 9;
    case GAME_ARGUMENT = 10;
    case ENTITY_SERVER = 11;
    case PRECOMPILED = 12;
    case GAME_DIRECTOR_ENTITY_SERVER = 13;
    case SCRIPTING = 14;
    case EXECUTE_CONTEXT = 15;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }

    public static function fromString(string $name) : self{
        return match($name){
            "player" => self::PLAYER,
            "commandblock" => self::BLOCK,
            "minecartcommandblock" => self::MINECART_BLOCK,
            "devconsole" => self::DEV_CONSOLE,
            "test" => self::TEST,
            "automationplayer" => self::AUTOMATION_PLAYER,
            "clientautomation" => self::CLIENT_AUTOMATION,
            "dedicatedserver" => self::DEDICATED_SERVER,
            "entity" => self::ENTITY,
            "virtual" => self::VIRTUAL,
            "gameargument" => self::GAME_ARGUMENT,
            "entityserver" => self::ENTITY_SERVER,
            "precompiled" => self::PRECOMPILED,
            "gamedirectorentityserver" => self::GAME_DIRECTOR_ENTITY_SERVER,
            "scripting" => self::SCRIPTING,
            "executecontext" => self::EXECUTE_CONTEXT,
            default => self::UNKNOWN
        };
    }

    public function toString() : string{
        return match($this){
            self::PLAYER => "player",
            self::BLOCK => "commandblock",
            self::MINECART_BLOCK => "minecartcommandblock",
            self::DEV_CONSOLE => "devconsole",
            self::TEST => "test",
            self::AUTOMATION_PLAYER => "automationplayer",
            self::CLIENT_AUTOMATION => "clientautomation",
            self::DEDICATED_SERVER => "dedicatedserver",
            self::ENTITY => "entity",
            self::VIRTUAL => "virtual",
            self::GAME_ARGUMENT => "gameargument",
            self::ENTITY_SERVER => "entityserver",
            self::PRECOMPILED => "precompiled",
            self::GAME_DIRECTOR_ENTITY_SERVER => "gamedirectorentityserver",
            self::SCRIPTING => "scripting",
            self::EXECUTE_CONTEXT => "executecontext",
            default => throw new \InvalidArgumentException("Unknown command origin type: " . $this->name)
        };
    }
}