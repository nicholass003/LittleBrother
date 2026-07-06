<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_e99fc66fa59af4fa\Nicholass003\Axiom\Data\PacketRecipient;

class SubClientLoginPacket implements Packet{

    public const ID = PacketIds::SUB_CLIENT_LOGIN;
    public const RECIPIENT = PacketRecipient::SERVER;

    public string $connectionRequestData;
}