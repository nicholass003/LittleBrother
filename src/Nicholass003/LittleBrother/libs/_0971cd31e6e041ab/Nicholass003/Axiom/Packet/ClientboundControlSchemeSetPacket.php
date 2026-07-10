<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Enum\ControlScheme;

class ClientboundControlSchemeSetPacket implements Packet{

    public const ID = PacketIds::CLIENTBOUND_CONTROL_SCHEME_SET;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public ControlScheme $scheme;
}