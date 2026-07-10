<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;

class ShowProfilePacket implements Packet{

    public const ID = PacketIds::SHOW_PROFILE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $xboxUserId;
}