<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Version\ProtocolVersion;

class LoginPacket implements Packet{

    public const ID = PacketIds::LOGIN;
    public const RECIPIENT = PacketRecipient::SERVER;

    public ProtocolVersion $protocol;
    public string $authInfoJson;
    public string $clientDataJwt;
}