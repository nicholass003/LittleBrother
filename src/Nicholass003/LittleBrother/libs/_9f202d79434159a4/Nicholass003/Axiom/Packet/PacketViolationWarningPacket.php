<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;

class PacketViolationWarningPacket implements Packet{

    public const ID = PacketIds::PACKET_VIOLATION_WARNING;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $type;
    public int $severity;
    public int $packetId;
    public string $context;
}