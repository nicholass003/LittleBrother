<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Enum;

enum PlayerAction : int{

    case UNKNOWN = -1;
    case START_BREAK = 0;
    case ABORT_BREAK = 1;
    case STOP_BREAK = 2;
    case GET_UPDATED_BLOCK = 3;
    case DROP_ITEM = 4;
    case START_SLEEPING = 5;
    case STOP_SLEEPING = 6;
    case RESPAWN = 7;
    case JUMP = 8;
    case START_SPRINT = 9;
    case STOP_SPRINT = 10;
    case START_SNEAK = 11;
    case STOP_SNEAK = 12;
    case CREATIVE_PLAYER_DESTROY_BLOCK = 13;
    case DIMENSION_CHANGE_ACK = 14;
    case START_GLIDE = 15;
    case STOP_GLIDE = 16;
    case BUILD_DENIED = 17;
    case CRACK_BREAK = 18;
    /**
     * @var self Semantic alias for CRACK_BREAK
     */
    public const CRACK_BLOCK = self::CRACK_BREAK;
    case CHANGE_SKIN = 19;
    case SET_ENCHANTMENT_SEED = 20;
    case START_SWIMMING = 21;
    case STOP_SWIMMING = 22;
    case START_SPIN_ATTACK = 23;
    case STOP_SPIN_ATTACK = 24;
    case INTERACT_BLOCK = 25;
    case PREDICT_DESTROY_BLOCK = 26;
    case CONTINUE_DESTROY_BLOCK = 27;
    case START_ITEM_USE_ON = 28;
    case STOP_ITEM_USE_ON = 29;
    case HANDLED_TELEPORT = 30;
    case MISSED_SWING = 31;
    case START_CRAWLING = 32;
    case STOP_CRAWLING = 33;
    case START_FLYING = 34;
    case STOP_FLYING = 35;
    case START_USING_ITEM = 37;

    public static function safe(int $value) : self{
        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}