<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum;

enum ActorEventType : int{

    case UNKNOWN = 0;
    case JUMP = 1;
    case HURT_ANIMATION = 2;
    case DEATH_ANIMATION = 3;
    case ARM_SWING = 4;
    case STOP_ATTACK = 5;
    case TAME_FAIL = 6;
    case TAME_SUCCESS = 7;
    case SHAKE_WET = 8;
    case USE_ITEM = 9;
    case EAT_GRASS_ANIMATION = 10;
    case FISH_HOOK_BUBBLE = 11;
    case FISH_HOOK_POSITION = 12;
    case FISH_HOOK_HOOK = 13;
    case FISH_HOOK_TEASE = 14;
    case SQUID_INK_CLOUD = 15;
    case ZOMBIE_VILLAGER_CURE = 16;
    case PLAY_AMBIENT_SOUND = 17;
    case RESPAWN = 18;
    case IRON_GOLEM_OFFER_FLOWER = 19;
    case IRON_GOLEM_WITHDRAW_FLOWER = 20;
    case LOVE_PARTICLES = 21;
    case VILLAGER_ANGRY = 22;
    case VILLAGER_HAPPY = 23;
    case WITCH_SPELL_PARTICLES = 24;
    case FIREWORK_PARTICLES = 25;
    case IN_LOVE_PARTICLES = 26;
    case SILVERFISH_SPAWN_ANIMATION = 27;
    case GUARDIAN_ATTACK = 28;
    case WITCH_DRINK_POTION = 29;
    case WITCH_THROW_POTION = 30;
    case MINECART_TNT_PRIME_FUSE = 31;
    case CREEPER_PRIME_FUSE = 32;
    case AIR_SUPPLY_EXPIRED = 33;
    case PLAYER_ADD_XP_LEVELS = 34;
    case ELDER_GUARDIAN_CURSE = 35;
    case AGENT_ARM_SWING = 36;
    case ENDER_DRAGON_DEATH = 37;
    case DUST_PARTICLES = 38;
    case ARROW_SHAKE = 39;

    case EATING_ITEM = 57;

    case BABY_ANIMAL_FEED = 60;
    case DEATH_SMOKE_CLOUD = 61;
    case COMPLETE_TRADE = 62;
    case REMOVE_LEASH = 63;
    case CARAVAN_UPDATED = 64;
    case CONSUME_TOTEM = 65;
    case DEPRECATED_UPDATE_STRUCTURE_FEATURE = 66;
    case ENTITY_SPAWN = 67;
    case DRAGON_PUKE = 68;
    case ITEM_ENTITY_MERGE = 69;
    case START_SWIM = 70;
    case BALLOON_POP = 71;
    case TREASURE_HUNT = 72;
    case AGENT_SUMMON = 73;
    case CHARGED_ITEM = 74;
    case FALL = 75;
    case GROW_UP = 76;
    case VIBRATION_DETECTED = 77;
    case DRINK_MILK = 78;
    /** @since v859 */
    case SHAKE_WETNESS_STOP = 79;
    /** @since v898 */
    case KINETIC_DAMAGE_DEALT = 80;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}