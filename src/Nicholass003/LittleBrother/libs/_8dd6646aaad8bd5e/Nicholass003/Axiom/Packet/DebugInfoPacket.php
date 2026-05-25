<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;

class DebugInfoPacket implements Packet{

    public const ID = PacketIds::DEBUG_INFO;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $actorUniqueId;
    public string $data;
}