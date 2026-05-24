<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum;

enum MoveActorDeltaFlag : int{

    case HAS_X = 0x01;
    case HAS_Y = 0x02;
    case HAS_Z = 0x04;
    case HAS_PITCH = 0x08;
    case HAS_YAW = 0x10;
    case HAS_HEAD_YAW = 0x20;
    case GROUND = 0x40;
    case TELEPORT = 0x80;
    case FORCE_MOVE_LOCAL_ENTITY = 0x100;
}