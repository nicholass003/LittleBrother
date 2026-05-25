<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;

class MovementEffectPacket implements Packet{

    public const ID = PacketIds::MOVEMENT_EFFECT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $actorRuntimeId;
    public int $effectType;
    public int $duration;
    public int $tick;
}