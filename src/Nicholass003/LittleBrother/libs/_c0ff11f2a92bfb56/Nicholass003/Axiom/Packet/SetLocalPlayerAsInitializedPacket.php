<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;

class SetLocalPlayerAsInitializedPacket implements Packet{

    public const ID = PacketIds::SET_LOCAL_PLAYER_AS_INITIALIZED;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $actorRuntimeId;
}