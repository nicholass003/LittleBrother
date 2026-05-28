<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Data\Type\Vec3;
use Nicholass003\LittleBrother\libs\_86ef34ea2444fabf\Nicholass003\Axiom\Enum\MovePlayerMode;

class MovePlayerPacket implements Packet{

    public const MODE_NORMAL = 0;
    public const MODE_RESET = 1;
    public const MODE_TELEPORT = 2;
    public const MODE_PITCH = 3;

    public const ID = PacketIds::MOVE_PLAYER;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $actorRuntimeId;
    public Vec3 $position;
    public float $pitch = 0.0;
    public float $yaw = 0.0;
    public float $headYaw = 0.0;
    public MovePlayerMode $mode;
    public bool $onGround = false;
    public int $ridingActorRuntimeId = 0;
    public int $teleportCause = 0;
    public int $teleportItem = 0;
    public int $tick = 0;
}