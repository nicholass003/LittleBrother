<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;

class SettingsCommandPacket implements Packet{

    public const ID = PacketIds::SETTINGS_COMMAND;
    public const RECIPIENT = PacketRecipient::SERVER;

    public string $command;
    public bool $suppressOutput;
}