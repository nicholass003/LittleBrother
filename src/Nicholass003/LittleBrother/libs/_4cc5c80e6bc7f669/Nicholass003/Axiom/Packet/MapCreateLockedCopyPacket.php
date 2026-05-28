<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cc5c80e6bc7f669\Nicholass003\Axiom\Data\PacketRecipient;

class MapCreateLockedCopyPacket implements Packet{

    public const ID = PacketIds::MAP_CREATE_LOCKED_COPY;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $originalMapId;
    public int $newMapId;
}