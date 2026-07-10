<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;

class TickingAreasLoadStatusPacket implements Packet{

    public const ID = PacketIds::TICKING_AREAS_LOAD_STATUS;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public bool $areasPreloaded;
}