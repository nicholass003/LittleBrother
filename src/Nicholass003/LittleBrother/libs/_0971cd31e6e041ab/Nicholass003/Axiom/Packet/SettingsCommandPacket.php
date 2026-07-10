<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;

class SettingsCommandPacket implements Packet{

    public const ID = PacketIds::SETTINGS_COMMAND;
    public const RECIPIENT = PacketRecipient::SERVER;

    public string $command;
    public bool $suppressOutput;
}