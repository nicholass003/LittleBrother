<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;

class DebugInfoPacket implements Packet{

    public const ID = PacketIds::DEBUG_INFO;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $actorUniqueId;
    public string $data;
}