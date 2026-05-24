<?php

declare(strict_types=1);

namespace Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Packet;

use Nicholass003\LittleBrother\libs\_2bb2a4bf9581c21d\Nicholass003\Axiom\Data\PacketRecipient;

class ContainerClosePacket implements Packet{

    public const ID = PacketIds::CONTAINER_CLOSE;
    public const RECIPIENT = PacketRecipient::BOTH;

    public int $windowId;
    public int $windowType;
    public bool $server = false;
}