<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\PacketRecipient;

class ServerToClientHandshakePacket implements Packet{

    public const ID = PacketIds::SERVER_TO_CLIENT_HANDSHAKE;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $jwt;
}