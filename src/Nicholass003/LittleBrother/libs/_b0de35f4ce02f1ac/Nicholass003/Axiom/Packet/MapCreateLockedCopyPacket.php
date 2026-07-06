<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\PacketRecipient;

class MapCreateLockedCopyPacket implements Packet{

    public const ID = PacketIds::MAP_CREATE_LOCKED_COPY;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $originalMapId;
    public int $newMapId;
}