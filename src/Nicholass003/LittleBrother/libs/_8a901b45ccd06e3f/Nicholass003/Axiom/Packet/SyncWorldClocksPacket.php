<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;

class SyncWorldClocksPacket implements Packet{

    public const ID = PacketIds::SYNC_WORLD_CLOCKS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    //TODO
}