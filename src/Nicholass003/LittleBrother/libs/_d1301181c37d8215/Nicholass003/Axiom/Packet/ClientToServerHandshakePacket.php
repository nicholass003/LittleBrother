<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_d1301181c37d8215\Nicholass003\Axiom\Data\PacketRecipient;

class ClientToServerHandshakePacket implements Packet{

    public const ID = PacketIds::CLIENT_TO_SERVER_HANDSHAKE;
    public const RECIPIENT = PacketRecipient::SERVER;

    // no fields
}