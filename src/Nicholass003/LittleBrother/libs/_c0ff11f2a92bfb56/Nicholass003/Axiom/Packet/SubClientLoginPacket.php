<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;

class SubClientLoginPacket implements Packet{

    public const ID = PacketIds::SUB_CLIENT_LOGIN;
    public const RECIPIENT = PacketRecipient::SERVER;

    public string $connectionRequestData;
}