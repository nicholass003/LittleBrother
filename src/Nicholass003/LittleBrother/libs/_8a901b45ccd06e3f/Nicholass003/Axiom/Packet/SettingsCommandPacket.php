<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8a901b45ccd06e3f\Nicholass003\Axiom\Data\PacketRecipient;

class SettingsCommandPacket implements Packet{

    public const ID = PacketIds::SETTINGS_COMMAND;
    public const RECIPIENT = PacketRecipient::SERVER;

    public string $command;
    public bool $suppressOutput;
}