<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Data\PacketRecipient;
use Nicholass003\LittleBrother\libs\_8dd6646aaad8bd5e\Nicholass003\Axiom\Version\ProtocolVersion;

class LoginPacket implements Packet{

    public const ID = PacketIds::LOGIN;
    public const RECIPIENT = PacketRecipient::SERVER;

    public ProtocolVersion $protocol;
    public string $authInfoJson;
    public string $clientDataJwt;
}