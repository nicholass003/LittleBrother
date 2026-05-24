<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;

class DisconnectPacket implements Packet{

    public const ID = PacketIds::DISCONNECT;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $reason;
    public ?string $message = null;
    public ?string $filteredMessage = null;
}