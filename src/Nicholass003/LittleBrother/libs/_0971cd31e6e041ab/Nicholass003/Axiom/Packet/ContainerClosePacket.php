<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_0971cd31e6e041ab\Nicholass003\Axiom\Data\PacketRecipient;

class ContainerClosePacket implements Packet{

    public const ID = PacketIds::CONTAINER_CLOSE;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $windowId;
    public int $windowType;
    public bool $server = false;
}