<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_9f202d79434159a4\Nicholass003\Axiom\Data\PacketRecipient;

class DisconnectPacket implements Packet{

    public const ID = PacketIds::DISCONNECT;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $reason;
    public ?string $message = null;
    public ?string $filteredMessage = null;
}