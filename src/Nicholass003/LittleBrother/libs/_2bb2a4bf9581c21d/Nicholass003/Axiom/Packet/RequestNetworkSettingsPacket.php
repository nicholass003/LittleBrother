<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;

class RequestNetworkSettingsPacket implements Packet{

    public const ID = PacketIds::REQUEST_NETWORK_SETTINGS;
    public const RECIPIENT = PacketRecipient::SERVER;

    public int $protocolVersion;
}