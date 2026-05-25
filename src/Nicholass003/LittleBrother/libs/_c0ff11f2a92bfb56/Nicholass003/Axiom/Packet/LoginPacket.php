<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_c0ff11f2a92bfb56\Nicholass003\Axiom\Version\ProtocolVersion;

class LoginPacket implements Packet{

    public const ID = PacketIds::LOGIN;
    public const RECIPIENT = PacketRecipient::SERVER;

    public ProtocolVersion $protocol;
    public string $authInfoJson;
    public string $clientDataJwt;
}