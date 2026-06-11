<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_4cca2350a8ef3979\Nicholass003\Axiom\Data\PacketRecipient;

class ClientToServerHandshakePacket implements Packet{

    public const ID = PacketIds::CLIENT_TO_SERVER_HANDSHAKE;
    public const RECIPIENT = PacketRecipient::SERVER;

    // no fields
}