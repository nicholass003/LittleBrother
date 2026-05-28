<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\Type\Vec3;

class RespawnPacket implements Packet{

    public const ID = PacketIds::RESPAWN;
    public const RECIPIENT = PacketRecipient::BOTH;

    public Vec3 $position;
    public int $respawnState;
    public int $actorRuntimeId;
}