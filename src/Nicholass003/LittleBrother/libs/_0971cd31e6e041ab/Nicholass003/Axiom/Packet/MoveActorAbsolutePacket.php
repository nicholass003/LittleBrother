<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Vec3;

class MoveActorAbsolutePacket implements Packet{

    public const ID = PacketIds::MOVE_ACTOR_ABSOLUTE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorRuntimeId;
    public int $flags;
    public Vec3 $position;
    public float $pitch = 0.0;
    public float $yaw = 0.0;
    public float $headYaw = 0.0;
}