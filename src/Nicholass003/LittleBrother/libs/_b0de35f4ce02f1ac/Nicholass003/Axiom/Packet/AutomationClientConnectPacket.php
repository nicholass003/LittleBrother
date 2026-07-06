<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_b0de35f4ce02f1ac\Nicholass003\Axiom\Data\PacketRecipient;

class AutomationClientConnectPacket implements Packet{

    public const ID = PacketIds::AUTOMATION_CLIENT_CONNECT;
    public const RECIPIENT = PacketRecipient::CLIENT;

    public string $serverUri;
}