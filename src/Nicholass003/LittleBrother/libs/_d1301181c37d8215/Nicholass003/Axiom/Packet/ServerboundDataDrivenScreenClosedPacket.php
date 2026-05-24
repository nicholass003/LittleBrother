<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;

class ServerboundDataDrivenScreenClosedPacket implements Packet{

    public const ID = PacketIds::SERVERBOUND_DATA_DRIVEN_SCREEN_CLOSED;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $formId = 0;
    public string $closeReason = '';
}