<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_89851775efbc387c\Nicholass003\Axiom\Data\PacketRecipient;

class SetTimePacket implements Packet{

    public const ID = PacketIds::SET_TIME;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $time;
}