<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;

class ServerSettingsRequestPacket implements Packet{

    public const ID = PacketIds::SERVER_SETTINGS_REQUEST;
    public const RECIPIENT = PacketRecipient::SERVER;

    // no fields
}