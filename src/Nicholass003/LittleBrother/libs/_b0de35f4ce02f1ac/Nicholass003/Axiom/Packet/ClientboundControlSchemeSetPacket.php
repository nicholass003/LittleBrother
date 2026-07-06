<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Enum\ControlScheme;

class ClientboundControlSchemeSetPacket implements Packet{

    public const ID = PacketIds::CLIENTBOUND_CONTROL_SCHEME_SET;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public ControlScheme $scheme;
}