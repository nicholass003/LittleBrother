<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;

class LevelEventGenericPacket implements Packet{

    public const ID = PacketIds::LEVEL_EVENT_GENERIC;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $eventId;
    public string $eventData; // Raw NBT binary
}