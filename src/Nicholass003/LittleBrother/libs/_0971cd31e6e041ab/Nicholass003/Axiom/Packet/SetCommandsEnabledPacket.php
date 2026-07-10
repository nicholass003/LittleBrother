<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;

class SetCommandsEnabledPacket implements Packet{

    public const ID = PacketIds::SET_COMMANDS_ENABLED;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public bool $enabled;
}