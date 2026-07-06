<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\PacketRecipient;

class SetTimePacket implements Packet{

    public const ID = PacketIds::SET_TIME;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public int $time;
}