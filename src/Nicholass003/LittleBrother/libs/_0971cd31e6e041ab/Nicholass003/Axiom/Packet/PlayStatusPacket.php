<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\PlayStatusType;

class PlayStatusPacket implements Packet{

    public const ID = PacketIds::PLAY_STATUS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public PlayStatusType $status;
}