<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Enum;

enum LegacyTelemetryEventType : int{

    case UNKNOWN = -1;
    case ACHIEVEMENT_AWARDED = 0;
    case ENTITY_INTERACT = 1;
    case PORTAL_BUILT = 2;
    case PORTAL_USED = 3;
    case MOB_KILLED = 4;
    case CAULDRON_USED = 5;
    case PLAYER_DEATH = 6;
    case BOSS_KILLED = 7;
    case AGENT_COMMAND = 8;
    case AGENT_CREATED = 9;
    case PATTERN_REMOVED = 10;
    case COMMAND_EXECUTED = 11;
    case FISH_BUCKETED = 12;
    case MOB_BORN = 13;
    case PET_DIED = 14;
    case CAULDRON_BLOCK_USED = 15;
    case COMPOSTER_BLOCK_USED = 16;
    case BELL_BLOCK_USED = 17;
    case ACTOR_DEFINITION = 18;
    case RAID_UPDATE = 19;
    case PLAYER_MOVEMENT_ANOMALY = 20;
    case PLAYER_MOVEMENT_CORRECTED = 21;
    case HONEY_HARVESTED = 22;
    case TARGET_BLOCK_HIT = 23;
    case PIGLIN_BARTER = 24;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}