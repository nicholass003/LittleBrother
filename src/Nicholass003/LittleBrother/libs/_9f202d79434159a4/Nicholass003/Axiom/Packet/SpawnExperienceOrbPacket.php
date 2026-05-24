<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\Type\Vec3;

class SpawnExperienceOrbPacket implements Packet{

    public const ID = PacketIds::SPAWN_EXPERIENCE_ORB;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public Vec3 $position;
    public int $amount;
}