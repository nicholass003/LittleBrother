<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Enum\SimpleEventType;

class SimpleEventPacket implements Packet{

    public const ID = PacketIds::SIMPLE_EVENT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public SimpleEventType $eventType;
}