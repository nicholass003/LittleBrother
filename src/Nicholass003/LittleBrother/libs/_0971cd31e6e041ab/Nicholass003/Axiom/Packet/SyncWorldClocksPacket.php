<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;

class SyncWorldClocksPacket implements Packet{

    public const ID = PacketIds::SYNC_WORLD_CLOCKS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    //TODO
}