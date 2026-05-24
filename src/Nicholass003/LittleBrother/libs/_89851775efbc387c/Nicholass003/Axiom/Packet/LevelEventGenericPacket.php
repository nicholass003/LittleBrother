<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\PacketRecipient;

class LevelEventGenericPacket implements Packet{

    public const ID = PacketIds::LEVEL_EVENT_GENERIC;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $eventId;
    public string $eventData; // Raw NBT binary
}