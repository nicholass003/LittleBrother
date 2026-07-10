<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\Type\Vec3;

class SetActorMotionPacket implements Packet{

    public const ID = PacketIds::SET_ACTOR_MOTION;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorRuntimeId;
    public Vec3 $motion;
    public int $tick;
}