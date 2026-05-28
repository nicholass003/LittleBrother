<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Enum;

enum PlayerAuthInputFlag : int{

    case ASCEND = 0;
    case DESCEND = 1;
    case NORTH_JUMP = 2;
    case JUMP_DOWN = 3;
    case SPRINT_DOWN = 4;
    case CHANGE_HEIGHT = 5;
    case JUMPING = 6;
    case AUTO_JUMPING_IN_WATER = 7;
    case SNEAKING = 8;
    case SNEAK_DOWN = 9;
    case UP = 10;
    case DOWN = 11;
    case LEFT = 12;
    case RIGHT = 13;
    case UP_LEFT = 14;
    case UP_RIGHT = 15;
    case WANT_UP = 16;
    case WANT_DOWN = 17;
    case WANT_DOWN_SLOW = 18;
    case WANT_UP_SLOW = 19;
    case SPRINTING = 20;
    case ASCEND_BLOCK = 21;
    case DESCEND_BLOCK = 22;
    case SNEAK_TOGGLE_DOWN = 23;
    case PERSIST_SNEAK = 24;
    case START_SPRINTING = 25;
    case STOP_SPRINTING = 26;
    case START_SNEAKING = 27;
    case STOP_SNEAKING = 28;
    case START_SWIMMING = 29;
    case STOP_SWIMMING = 30;
    case START_JUMPING = 31;
    case START_GLIDING = 32;
    case STOP_GLIDING = 33;
    case PERFORM_ITEM_INTERACTION = 34;
    case PERFORM_BLOCK_ACTIONS = 35;
    case PERFORM_ITEM_STACK_REQUEST = 36;
    case HANDLED_TELEPORT = 37;
    case EMOTING = 38;
    case MISSED_SWING = 39;
    case START_CRAWLING = 40;
    case STOP_CRAWLING = 41;
    case START_FLYING = 42;
    case STOP_FLYING = 43;
    case ACK_ACTOR_DATA = 44;
    case IN_CLIENT_PREDICTED_VEHICLE = 45;
    case PADDLING_LEFT = 46;
    case PADDLING_RIGHT = 47;
    case BLOCK_BREAKING_DELAY_ENABLED = 48;
    case HORIZONTAL_COLLISION = 49;
    case VERTICAL_COLLISION = 50;
    case DOWN_LEFT = 51;
    case DOWN_RIGHT = 52;
    case START_USING_ITEM = 53;
    case IS_CAMERA_RELATIVE_MOVEMENT_ENABLED = 54;
    case IS_ROT_CONTROLLED_BY_MOVE_DIRECTION = 55;
    case START_SPIN_ATTACK = 56;
    case STOP_SPIN_ATTACK = 57;
    case IS_HOTBAR_ONLY_TOUCH = 58;
    case JUMP_RELEASED_RAW = 59;
    case JUMP_PRESSED_RAW = 60;
    case JUMP_CURRENT_RAW = 61;
    case SNEAK_RELEASED_RAW = 62;
    case SNEAK_PRESSED_RAW = 63;
    case SNEAK_CURRENT_RAW = 64;

    case NUMBER_OF_FLAGS = 65;
}