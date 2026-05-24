<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;

class ClientboundCloseFormPacket implements Packet{

    public const ID = PacketIds::CLIENTBOUND_CLOSE_FORM;
    public const RECIPIENT = PacketRecipient::CLIENT;

    // no fields
}